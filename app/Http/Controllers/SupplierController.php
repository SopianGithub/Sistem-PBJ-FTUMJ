<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreUploadPdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Supplier', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'max:255'],
            'tempat_lahir' => ['required', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'nama_badan_usaha' => ['required', 'max:255'],
            'alamat_badan_usaha' => ['required', 'max:255'],
            'nomor_hp' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email'],
            'suratPenawaran' => ['required', 'file']
        ]);
        
        $suratPenawaran = "";
        if($request->hasFile('suratPenawaran')){
            $suratPenawaran = $request->file('suratPenawaran')->store('dokumen_suppliers', 'public');
        }

        $tgl_lahir = date('Y-m-d', strtotime($request->post('tanggal_lahir')));
        $tanggal_lahir = Carbon::parse($tgl_lahir)->format('Y-m-d');

        $data = Supplier::create([
            'nama_lengkap' => $request->post('nama_lengkap'),
            'tempat_lahir' => $request->post('tempat_lahir'),
            'tanggal_lahir' => $tanggal_lahir,
            'nama_badan_usaha' => $request->post('nama_badan_usaha'),
            'alamat_badan_usaha' => $request->post('alamat_badan_usaha'),
            'nomor_hp' => $request->post('nomor_hp'),
            'email' => $request->post('email'),
            'alamat_web' => $request->post('alamat_web'),
            'surat_penawaran' => $suratPenawaran
        ]);

        return Redirect::route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('suppliers')->where('id', '=', $id)->get();
        $data = collect($data[0]);
        return Inertia::render('Admin/VendorsEdit', [
            'dataEdit' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'max:255'],
            'tempat_lahir' => ['required', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'nama_badan_usaha' => ['required', 'max:255'],
            'alamat_badan_usaha' => ['required', 'max:255'],
            'nomor_hp' => ['required', 'max:255'],
            'email' => ['required', 'max:255', 'email']
        ]);
        
        $suratPenawaran = $request->post('linkSuratPenawaran');
        if($request->hasFile('suratPenawaran')){
            $suratPenawaran = $request->file('suratPenawaran')->store('dokumen_suppliers', 'public');
        }

        $tgl_lahir = date('Y-m-d', strtotime($request->post('tanggal_lahir')));
        $tanggal_lahir = Carbon::parse($tgl_lahir)->format('Y-m-d');

        $update = DB::table('suppliers')
                    ->where('id', '=', $request->id)
                    ->update([
                        'nama_lengkap' => $request->post('nama_lengkap'),
                        'tempat_lahir' => $request->post('tempat_lahir'),
                        'tanggal_lahir' => $tanggal_lahir,
                        'nama_badan_usaha' => $request->post('nama_badan_usaha'),
                        'alamat_badan_usaha' => $request->post('alamat_badan_usaha'),
                        'nomor_hp' => $request->post('nomor_hp'),
                        'email' => $request->post('email'),
                        'alamat_web' => $request->post('alamat_web'),
                        'surat_penawaran' => $suratPenawaran
                    ]);

        return Redirect::route('Admin.penawaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }

    public function storePdf(Request $request)
    {
        $image_path = '';
        $res = false;
        if ($request->hasFile('file')) {
            $res = $request->file('file')->store('dokumen_suppliers', 'public');
        }
        return $res;
    }
}
