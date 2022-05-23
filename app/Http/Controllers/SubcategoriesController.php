<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;

class SubcategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Subkategoi';
        $subcategories = SubCategory::orderBy('id', 'asc')->get();

        return view('admin.subcategory.index', compact('title', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Subkategori';
        $categories = Category::orderBy('name', 'asc')->get();
        return view('admin.subcategory.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'subname' => 'required|unique:sub_categories'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request['subname']);

        SubCategory::create($data);

        return redirect()->route('subcategory.index')->with('message', "Subkategori $request->subname berhasil dibuat");
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
        $subcategory = SubCategory::find($id);
        $categories = Category::orderBy('name', 'asc')->get();
        $title = 'Ubah Subkategori';
        return view('admin.subcategory.edit', compact('title', 'categories', 'subcategory'));
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
        $this->validate($request, [
            'category_id' => 'required',
            'subname' => 'required'
        ]);

        $data = $request->all();
        $subcategory = SubCategory::find($id);
        $data['slug'] = Str::slug($request['subname']);

        $subcategory->update($data);
        return redirect()->route('subcategory.index')->with('message', "Subkategori $request->subname berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);
        $posts = Post::where('sub_category_id', $id)->get();
        foreach ($posts as $post) {
            $insert = Post::find($post['id']);
            $insert['sub_category_id'] = 0;
            $insert->update();
        }
        $subcategory->delete();
        return redirect()->route('subcategory.index')->with('message', "Subkategori $subcategory->subname berhasil dihapus ke tong sampah");
    }

    public function trash()
    {
        $subcategories = SubCategory::onlyTrashed()->get();
        $title = 'Tong Sampah Subkategori';
        return view('admin.subcategory.trash', compact('title', 'subcategories'));
    }

    public function restore($id)
    {
        SubCategory::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('subcategory.trash')->with('message', "Subkategori berhasil dikembalikan");
    }

    public function delete($id)
    {
        SubCategory::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('subcategory.trash')->with('message', "Subkategori berhasil dihapus");
    }
}
