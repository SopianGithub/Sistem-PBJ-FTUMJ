<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DaftarBarangController;
use App\Http\Controllers\SupplierController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

// Route::get('/prosedur', function () {
//     return Inertia::render('Prosedur', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'content' => [\App\Http\Controllers\Admin\CmsController::class, 'getContent/Prosedur']
//     ]);
// });

// Route::get('/ketentuan', function () {
//     return Inertia::render('Ketentuan', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//     ]);
// });

Route::get('/prosedur', [\App\Http\Controllers\Admin\CmsController::class, 'getContentProsedure'])->name('prosedur');
Route::get('/ketentuan', [\App\Http\Controllers\Admin\CmsController::class, 'getContentKetentuan'])->name('ketentuan');


Route::get('listInvent', [DaftarBarangController::class, 'index'])
    ->middleware('guest')->name('listInvent');

Route::get('supplier', [SupplierController::class, 'index'])
    ->middleware('guest')->name('supplier');
Route::post('supplier', [SupplierController::class, 'store'])
->middleware('guest')->name('supplier.store');

Route::post('supplier/upload', [SupplierController::class, 'storePdf'])
    ->middleware('guest')->name('supplier.upload');
    

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'role:Pengusul', 'prefix' => 'Pengusul', 'as' => 'Pengusul.'], function() {
        Route::get('index', [\App\Http\Controllers\Pengusul\PengusulController::class, 'index'])->name('index');
        Route::get('list', [\App\Http\Controllers\Pengusul\PengusulController::class, 'list'])->name('list');
        Route::get('create/{jenis_usulan?}', [\App\Http\Controllers\Pengusul\PengusulController::class, 'create'])->name('create');
        Route::post('store', [\App\Http\Controllers\Pengusul\PengusulController::class, 'store'])->name('store');
        Route::get('edit/{id?}/{jenis_usulan?}', [\App\Http\Controllers\Pengusul\PengusulController::class, 'edit'])->name('edit');
        Route::put('update/{id?}', [\App\Http\Controllers\Pengusul\PengusulController::class, 'update'])->name('update');
        Route::delete('delete/{id?}/{jenis_usulan?}', [\App\Http\Controllers\Pengusul\PengusulController::class, 'delete'])->name('delete');
    });
    Route::group(['middleware' => 'role:Validator', 'prefix' => 'Validator', 'as' => 'Validator.'], function() {
        Route::get('index', [\App\Http\Controllers\Validator\ValidatorController::class, 'index'])->name('index');
        Route::get('permohonan', [\App\Http\Controllers\Validator\ValidatorController::class, 'permohonan'])->name('permohonan');
        Route::post('permohonan', [\App\Http\Controllers\Validator\ValidatorController::class, 'approvalPermohonan'])->name('permohonan.approval');
        Route::get('persetujuan', [\App\Http\Controllers\Validator\ValidatorController::class, 'persetujuan'])->name('persetujuan');
        Route::post('persetujuan', [\App\Http\Controllers\Validator\ValidatorController::class, 'approvalPersetujuan'])->name('persetujuan.approval');
        Route::get('penawaran', [\App\Http\Controllers\Validator\ValidatorController::class, 'penawaranVendors'])->name('penawaran');
        Route::delete('delete/{id?}', [\App\Http\Controllers\Validator\ValidatorController::class, 'deletePenawaran'])->name('delete');
    });
    Route::group(['middleware' => 'role:PBJ', 'prefix' => 'PBJ', 'as' => 'PBJ.'], function() {
        Route::get('index', [\App\Http\Controllers\PBJ\PBJController::class, 'index'])->name('index');
        Route::get('permohonan', [\App\Http\Controllers\PBJ\PBJController::class, 'permohonan'])->name('permohonan');
        Route::post('permohonan', [\App\Http\Controllers\PBJ\PBJController::class, 'approvalPermohonan'])->name('permohonan.approval');
        Route::get('persetujuan', [\App\Http\Controllers\PBJ\PBJController::class, 'persetujuan'])->name('persetujuan');
        Route::post('persetujuan', [\App\Http\Controllers\PBJ\PBJController::class, 'approvalPersetujuan'])->name('persetujuan.approval');
        Route::get('penawaran', [\App\Http\Controllers\PBJ\PBJController::class, 'penawaranVendors'])->name('penawaran');
        Route::post('penawaran', [\App\Http\Controllers\PBJ\PBJController::class, 'approvalPenawaran'])->name('penawaran.approval');
        Route::delete('delete/{id?}', [\App\Http\Controllers\PBJ\PBJController::class, 'deletePenawaran'])->name('delete');
    });
    Route::group(['middleware' => 'role:Admin', 'prefix' => 'Admin', 'as' => 'Admin.'], function() {
        Route::get('index', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
        Route::get('permohonan', [\App\Http\Controllers\Admin\AdminController::class, 'permohonan'])->name('permohonan');
        Route::get('edit_permohonan/{id?}/{jenis_usulan?}', [\App\Http\Controllers\Admin\AdminController::class, 'edit_permohonan'])->name('permohonan.edit');
        Route::put('update_permohonan/{id?}', [\App\Http\Controllers\Admin\AdminController::class, 'update_permohonan'])->name('permohonan.update');
        Route::delete('delete_permohonan/{id?}/{jenis_usulan?}', [\App\Http\Controllers\Admin\AdminController::class, 'delete_permohonan'])->name('permohonan.delete');
        Route::get('penawaran', [\App\Http\Controllers\Admin\AdminController::class, 'penawaranVendors'])->name('penawaran');
        Route::get('penawaran_edit/{id?}', [\App\Http\Controllers\SupplierController::class, 'edit'])->name('penawaran.edit');
        Route::put('penawaran_edit/{id?}', [\App\Http\Controllers\SupplierController::class, 'update'])->name('penawaran.update');
        Route::get('users', [\App\Http\Controllers\Admin\AdminController::class, 'listUser'])->name('users');
        Route::get('users_create/{id?}', [\App\Http\Controllers\Admin\AdminController::class, 'register'])->name('users.create');
        Route::post('users_create', [\App\Http\Controllers\Admin\AdminController::class, 'createUsers'])->name('users.store');
        Route::put('users_update/{id?}', [\App\Http\Controllers\Admin\AdminController::class, 'updateUsers'])->name('users.update');
        Route::delete('users_delete/{id?}', [\App\Http\Controllers\Admin\AdminController::class, 'deleteUsers'])->name('users.delete');

        Route::get('inventory', [DaftarBarangController::class, 'index'])->name('inventory.index');
        Route::get('inventory/create', [DaftarBarangController::class, 'create'])->name('inventory.create');
        Route::post('inventory/store', [DaftarBarangController::class, 'store'])->name('inventory.store');
        Route::get('inventory/edit/{id?}', [DaftarBarangController::class, 'edit'])->name('inventory.edit');
        Route::put('inventory/update/{id?}', [DaftarBarangController::class, 'update'])->name('inventory.update');
        Route::delete('inventory/delete/{id?}', [DaftarBarangController::class, 'destroy'])->name('inventory.delete');

        Route::get('cms', [\App\Http\Controllers\Admin\CmsController::class, 'index'])->name('cms.index');
        Route::get('cms/create', [\App\Http\Controllers\Admin\CmsController::class, 'create'])->name('cms.create');
        Route::post('cms/store', [\App\Http\Controllers\Admin\CmsController::class, 'store'])->name('cms.store');
        Route::get('cms/edit/{id?}', [\App\Http\Controllers\Admin\CmsController::class, 'edit'])->name('cms.edit');
        Route::put('cms/update/{id?}', [\App\Http\Controllers\Admin\CmsController::class, 'update'])->name('cms.update');
        Route::get('cms/delete/{id?}', [\App\Http\Controllers\Admin\CmsController::class, 'destroy'])->name('cms.delete');
        Route::post('cms/upload', [\App\Http\Controllers\Admin\CmsController::class, 'uploadQuill'])->name('cms.upload');
    });
});