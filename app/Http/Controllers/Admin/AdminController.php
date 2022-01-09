<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\Pengusul;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;

class AdminController extends Controller
{

    use PasswordValidationRules;

    public function index()
    {
        return Inertia::render('Admin/Index', []);
    }

    /*  Data Permohonan */
    public function edit_permohonan($id, $jenis_usulan)
    {
        $data = DB::table('pengusuls')->where('id', '=', $id)->get();
        $data = collect($data[0]);
        return Inertia::render('Admin/DirectApp', [
            'dataEdit' => $data,
            'idUserAuth' => Auth::user()->id,
            'userameAuth' => Auth::user()->name,
            'jenisUsulan' =>  $jenis_usulan,
            'Action' => 'Update'
        ]);
    }

    public function update_permohonan(Request $request, $id)
    {
        # Validation File WHen Upload / Pengajuan Langsung
        $ifFile = $request->post('jenis_usulan') == "langung" ? "file" : "";
        # Execute Of Validation
        $request->validate([
            'nama_pengusul' => ['required', 'max:255'],
            'id_user' => ['required', 'max:4', 'integer'],
            'no_identitas' => ['required', 'integer'],
            'status_pengusul' => ['required', 'max:255'],
            'no_hp' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
            'keterangan' => ['required', 'max:255'],
            'surat_penawaran' => ['required_if:jenis_usulan,==,"langsung"', $ifFile]
        ]);

        #Process Of Upload File
        $suratPenawaran = "";
        if($request->hasFile('surat_penawaran')){
            $suratPenawaran = $request->file('surat_penawaran')->store('dokumen_pegusul/langsung/', 'public');
        }

        # Assign to update on Database
        $data = DB::table('pengusuls')
                    ->where('id', $id)
                    ->limit(1)
                    ->update([
                        'nama_pengusul' => $request->post('nama_pengusul'),
                        'id_user' => $request->post('id_user'),
                        'no_identitas' => $request->post('no_identitas'),
                        'status_pengusul' => $request->post('status_pengusul'),
                        'email' => $request->post('email'),
                        'no_hp' => $request->post('no_hp'),
                        'keterangan' => $request->post('keterangan'),
                        'surat_penawaran' => $suratPenawaran,
                        'jenis_usulan' =>  strtoupper($request->post('jenis_usulan')) 
                    ]);
        # Redirect to Dashoard
        return Redirect::route('Admin.permohonan', ['jenisUsulan'=> $request->post('jenis_usulan')]);
    }

    public function delete_permohonan($id, $jenis_usulan)
    {
        DB::table('pengusuls')->where('id', $id)->where('jenis_usulan', strtoupper($jenis_usulan))->delete();

        # Redirect to Dashoard
        return Redirect::route('Admin.permohonan', ['jenisUsulan'=> strtolower($jenis_usulan)]);
    }

    public function permohonan(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $list = Pengusul::select([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'id',
                'nama_pengusul',
                'id_user',
                'no_identitas',
                'status_pengusul',
                'email',
                'no_hp',
                'keterangan',
                'surat_penawaran',
                'status_validator',
                'status_pbj',
                'jenis_usulan'
                ])->when($request->term, function ($query, $term){
                        $query->where('keterangan', 'LIKE', '%'.$term.'%');
                    })
                    ->where('jenis_usulan', '=', strtoupper($request->jenisUsulan ?? 'lelang') )
                    ->paginate($request->perPage ? $request->perPage : 10);

        return Inertia::render('Admin/ListPermohonan', [
            'listData' => $list,
            'perPagePrm' => $request->perPage ??  10,
            'termPrm' => $request->term ?? '',
            'jenisUsulan'=> $request->jenisUsulan ?? 'lelang'
        ]);
    }

    /*  Data Penawaran */
    public function penawaranVendors(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $list = Supplier::select([
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'id', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'nama_badan_usaha', 'alamat_badan_usaha', 'nomor_hp', 'email', 'alamat_web', 'surat_penawaran', 'status_pbj'
                    ])->when($request->term, function ($query, $term){
                        $query->where('keterangan', 'LIKE', '%'.$term.'%');
                    })
                    ->paginate($request->perPage ? $request->perPage : 10);

        return Inertia::render('Admin/ListAppVendor', [
            'listData' => $list,
            'perPagePrm' => $request->perPage ??  10,
            'termPrm' => $request->term ?? ''
        ]);
    }

    # Kelola Hak Akses
    public function listUser(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $list = User::select([
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'name', 'email', 'tipe_user', 'password', 'id'
                    ])->when($request->term, function ($query, $term){
                        $query->where('keterangan', 'LIKE', '%'.$term.'%');
                    })
                    ->paginate($request->perPage ? $request->perPage : 10);

        return Inertia::render('Admin/ListUsers', [
            'listData' => $list,
            'perPagePrm' => $request->perPage ??  10,
            'termPrm' => $request->term ?? ''
        ]);
    }

    public function register($id = null)
    {
        $dataEdit = [];
        if(!empty($id)){
            $dataEdit = User::where('id', $id)->get();
            $dataEdit = collect($dataEdit[0]);
        }
        return Inertia::render('Admin/Users', [
            'dataEdit' => $dataEdit,
            'Actions' => !empty($id) ? "Update" : "Create"
        ]);
    }

    public function createUsers(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tipe_user' => ['required', 'string', 'max:100'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ]);

        User::create([
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'tipe_user' => $request->post('tipe_user'),
            'password' => Hash::make($request->post('password')),
        ]);

        return Redirect::route('Admin.users');
    }

    public function updateUsers(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tipe_user' => ['required', 'string', 'max:100'],
            'password' => $this->passwordRules(),
        ]);

        $data = User::where('id', $id)
                    ->limit(1)
                    ->update([
                        'name' => $request->post('name'),
                        'email' => $request->post('email'),
                        'tipe_user' => $request->post('tipe_user'),
                        'password' => Hash::make($request->post('password')),
                    ]);
        
        return Redirect::route('Admin.users');
    }

    public function deleteUsers($id)
    {
        $data = User::where('id', $id)
                    ->limit(1)
                    ->delete();
        
        return Redirect::route('Admin.users');
    }
}
