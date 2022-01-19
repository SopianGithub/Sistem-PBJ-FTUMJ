<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $list = Contents::select([
                    DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                    'title', 'categories', 'content',  'image', 'id'
                ])->when($request->term, function ($query, $term){
                        $query->where('content', 'LIKE', '%'.$term.'%');
                        $query->orWhere('title', 'LIKE', '%'.$term.'%');
                    })
                    ->paginate($request->perPage ? $request->perPage : 10);
        
        return Inertia::render('Admin/cms/List', [
            'listData' => $list,
            'perPagePrm' => $request->perPage ??  10,
            'termPrm' => $request->term ?? ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/cms/Form', [
            'Action' => 'Insert',
            'basUrl' => config('app.url'),
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
            'title' => ['required', 'string', 'max:255'],
            'categories' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

         #Process Of Upload File
        $images = "";
        if($request->hasFile('image')){
            $images = $request->file('image')->store('cms/'.$request->post('categories').'/', 'public');
        }
 

        $insert= Contents::create([
            'title' => $request->post('title'),
            'categories' => $request->post('categories'),
            'content' => $request->post('content'),
            'image' => $images,
        ]);

        return Redirect::route('Admin.cms.index');
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
        return Inertia::render('Admin/cms/Form', [
            'Action' => 'Update',
            'dataEdit' => collect(Contents::where('id', $id)->limit(1)->get()[0])
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
            'title' => ['required', 'string', 'max:255'],
            'categories' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string']
        ]);

         #Process Of Upload File
        $images = $request->post('imageExists');
        if($request->hasFile('image')){
            $images = $request->file('image')->store('cms/'.$request->post('categories').'/', 'public');
        }

        $update = Contents::where('id', $id)->limit(1)
                    ->update([
                        'title' => $request->post('title'),
                        'categories' => $request->post('categories'),
                        'content' => $request->post('content'),
                        'image' => $images,
                    ]);

        return Redirect::route('Admin.cms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contents::where('id', $id)->limit(1)->delete();

        return Redirect::route('Admin.cms.index');
    }

    public function uploadQuill(Request $request)
    {
        $images = "";
        if($request->hasFile('image')){
            $images = $request->file('image')->store('cms/quil-image/', 'public');
        }

        echo $images;
    }

    public function getContent($kategori = "Prosedur")
    {
        $data = Contents::where('categories', $kategori)
                    ->limit(1)
                    ->get();
        $data = collect($data[0]);
        return Inertia::render('Prosedur', [
            'content' => $data
        ]);
    }

    public function getContentProsedure($kategori = "Prosedur")
    {
        $data = Contents::where('categories', $kategori)
                    ->limit(1)
                    ->get();
        $data = collect($data[0]);
        return Inertia::render('Prosedur', [
            'content' => $data
        ]);
    }

    public function getContentKetentuan($kategori = "Ketentuan")
    {
        $data = Contents::where('categories', $kategori)
                    ->limit(1)
                    ->get();
        $data = collect($data[0]);
        return Inertia::render('Ketentuan', [
            'content' => $data
        ]);
    }
}
