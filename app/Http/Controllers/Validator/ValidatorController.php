<?php

namespace App\Http\Controllers\Validator;

use App\Http\Controllers\Controller;
use App\Models\History;
use App\Models\Pengusul;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ValidatorController extends Controller
{
    public function index()
    {
        return Inertia::render('Validator/Index', []);
    }

    /*  Data Permohonan */
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

        return Inertia::render('Validator/ListPermohonan', [
            'listData' => $list,
            'perPagePrm' => $request->perPage ??  10,
            'termPrm' => $request->term ?? '',
            'jenisUsulan'=> $request->jenisUsulan ?? 'lelang'
        ]);
    }

    public function approvalPermohonan(Request $request)
    {
        $request->validate([
            'id' => ['required', 'max:4', 'integer'],
            'jenis_usulan' => ['required'],
            'status' => ['required', 'max:255']
        ]);

       $res = DB::table('pengusuls')
                    ->where('id', $request->post('id'))
                    ->where('jenis_usulan', $request->post('jenis_usulan'))
                    ->limit(1)
                    ->update([ 'status_validator' => $request->post('status') ]);

        $res = History::create([
            'id_user' => Auth::user()->id,
            'jenis_action' => 'Approval Permohonan',
            'status' => $request->post('status'),
            'id_pengajuan' => $request->id
        ]);

        return response()->json([
            'status' => $res ? 'success' : 'failed',
            'message' => $res ? 'Approval Sukses Disimpan' : 'Approval Gagal Disimpan'
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

        return Inertia::render('Validator/ListAppVendor', [
            'listData' => $list,
            'perPagePrm' => $request->perPage ??  10,
            'termPrm' => $request->term ?? ''
        ]);
    }

    public function deletePenawaran($id)
    {
        DB::table('suppliers')->where('id', $id)->delete();

        # Redirect to Dashoard
        return Redirect::route('Validator.penawaran', []);
    }

    /*  Data Persetujuan */
    public function persetujuan(Request $request)
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

        return Inertia::render('Validator/ListPersetujuan', [
            'listData' => $list,
            'perPagePrm' => $request->perPage ??  10,
            'termPrm' => $request->term ?? '',
            'jenisUsulan'=> $request->jenisUsulan ?? 'lelang'
        ]);
    }

    public function approvalPersetujuan(Request $request)
    {
        $request->validate([
            'id' => ['required', 'max:4', 'integer'],
            'jenis_usulan' => ['required'],
            'status' => ['required', 'max:255']
        ]);

       $res = DB::table('pengusuls')
                    ->where('id', $request->post('id'))
                    ->where('jenis_usulan', $request->post('jenis_usulan'))
                    ->limit(1)
                    ->update([ 'status_app_validator' => $request->post('status') ]);

        $res = History::create([
            'id_user' => Auth::user()->id,
            'jenis_action' => 'Approval Persetujuan',
            'status' => $request->post('status'),
            'id_pengajuan' => $request->id
        ]);

        return response()->json([
            'status' => $res ? 'success' : 'failed',
            'message' => $res ? 'Approval Sukses Disimpan' : 'Approval Gagal Disimpan'
        ]);
    }
}
