<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daftar_barang;
use Inertia\Inertia;
use DB;

class DaftarBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = DB::table('daftar_barangs')
                    ->select(['id', 'nama_barang', 'unit', 'jumlah'])
                    ->selectRaw('CASE WHEN status = 1 THEN "Aktif" ELSE "Non Aktif" END As status')
                    ->when($request->term, function ($query, $term){
                        $query->where('nama_barang', 'LIKE', '%'.$term.'%');
                    })
                    ->paginate($request->perPage ? $request->perPage : 10);
        return Inertia::render('ListBarang', [
            'inventList' => $list,
            'perPagePrm' => $request->perPage ? $request->perPage :  10,
            'termPrm' => $request->term ?  $request->term : ''
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
