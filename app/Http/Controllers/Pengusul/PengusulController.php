<?php

namespace App\Http\Controllers\Pengusul;

use App\Http\Controllers\Controller;
use App\Models\Pengusul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB as FacadesDB;

class PengusulController extends Controller
{
    public function index()
    {
        return Inertia::render('Pengusul/Index', []);
    }

    public function list(Request $request)
    {
        FacadesDB::statement(FacadesDB::raw('set @rownum=0'));
        $list = Pengusul::select([
                FacadesDB::raw('@rownum  := @rownum  + 1 AS rownum'),
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
                'jenis_usulan'
                ])->when($request->term, function ($query, $term){
                        $query->where('keterangan', 'LIKE', '%'.$term.'%');
                    })
                    ->where('id_user', '=', Auth::user()->id)
                    ->where('jenis_usulan', '=', strtoupper($request->jenisUsulan ?? 'lelang') )
                    ->paginate($request->perPage ? $request->perPage : 10);

        return Inertia::render('Pengusul/ListAppDirect', [
            'listData' => $list,
            'perPagePrm' => $request->perPage ??  10,
            'termPrm' => $request->term ?? '',
            'jenisUsulan'=> $request->jenisUsulan ?? 'lelang'
        ]);
    }

    public function create($jenis_usulan = "lelang")
    {
        return Inertia::render('Pengusul/DirectApp', [
            'idUserAuth' => Auth::user()->id,
            'userameAuth' => Auth::user()->name,
            'jenisUsulan' => $jenis_usulan,
            'Action' => 'Insert',
            'dataEdit' => []
        ]);
    }

    public function store(Request $request)
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

        # Assign to save on Database
        $data = Pengusul::create([
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
        return Redirect::route('Pengusul.list', ['jenisUsulan'=> $request->post('jenis_usulan')]);
    }

    public function edit($id, $jenis_usulan)
    {
        $data = FacadesDB::table('pengusuls')->where('id', '=', $id)->get();
        $data = collect($data[0]);
        return Inertia::render('Pengusul/DirectApp', [
            'dataEdit' => $data,
            'idUserAuth' => Auth::user()->id,
            'userameAuth' => Auth::user()->name,
            'jenisUsulan' =>  $jenis_usulan,
            'Action' => 'Update'
        ]);
    }

    public function update(Request $request, $id)
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
        $data = FacadesDB::table('pengusuls')
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
        return Redirect::route('Pengusul.list', ['jenisUsulan'=> $request->post('jenis_usulan')]);
    }

    public function delete($id, $jenis_usulan)
    {
        FacadesDB::table('pengusuls')->where('id', $id)->where('jenis_usulan', strtoupper($jenis_usulan))->delete();

        # Redirect to Dashoard
        return Redirect::route('Pengusul.list', ['jenisUsulan'=> strtolower($jenis_usulan)]);
    }
}
