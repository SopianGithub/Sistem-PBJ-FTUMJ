<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daftar_barang;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Redirect;

class DaftarBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = FacadesDB::table('daftar_barangs')
                    ->select(['id', 'nama_barang', 'unit', 'jumlah'])
                    ->selectRaw('CASE WHEN status = 1 THEN "Aktif" ELSE "Non Aktif" END As status')
                    ->when($request->term, function ($query, $term){
                        $query->where('nama_barang', 'LIKE', '%'.$term.'%');
                    })
                    ->paginate($request->perPage ? $request->perPage : 10);
            
        return Inertia::render(
            (Auth::check()) ? (Auth::user()->tipe_user == "Admin") ? 'Admin/Inventory/List' :  'ListBarang' : 'ListBarang', 
        [
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
        return Inertia::render('Admin/Inventory/Form', [
            'Action' => 'Insert',
            'dataEdit' => []
        ]);
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
            'nama_barang' => ['required', 'max:255'],
            'jumlah' => ['required', 'max:99999999999999999', 'integer'],
            'unit' => ['required', 'max:255']
        ]);

        $data = Daftar_barang::create([
            'nama_barang' => $request->post('nama_barang'),
            'jumlah' => $request->post('jumlah'),
            'unit' => $request->post('unit'),
            'status' => $request->post('status')
        ]);

        return Redirect::route('Admin.inventory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Inertia::render('Admin/Inventory/Form', [
            'Action' => 'Update',
            'dataEdit' => collect(Daftar_barang::where('id', $id)->get()[0])
        ]);
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
        $request->validate([
            'nama_barang' => ['required', 'max:255'],
            'jumlah' => ['required', 'max:99999999999999999', 'integer'],
            'unit' => ['required', 'max:255']
        ]);

        $update = Daftar_barang::where('id', $id)
                    ->limit(1)
                    ->update([
                        'nama_barang' => $request->post('nama_barang'),
                        'jumlah' => $request->post('jumlah'),
                        'unit' => $request->post('unit'),
                        'status' => $request->post('status')
                    ]);

        return Redirect::route('Admin.inventory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Daftar_barang::where('id', $id)->limit(1)->delete();

        return Redirect::route('Admin.inventory.index');
    }
}
