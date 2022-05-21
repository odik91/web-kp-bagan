<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Image;

class CategoriesController extends Controller
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
        $title = 'List Kategori';
        $categories = Category::orderBy('id', 'asc')->get();
        return view('admin.categories.index', compact('title', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Buat Kategori';
        return view('admin.categories.create', compact('title'));
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
            'name' => 'required|min:3',
            'description' => 'required|min:3'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request['name']);
        Category::create($data);

        return redirect()->route('category.index')->with('message', "Kategori $request->name berhasil dibuat");
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
        $title = 'Edit Kategori';
        $category = Category::where('id', $id)->first();
        return view('admin.categories.edit', compact('title', 'category'));
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
            'name' => 'required|min:3',
            'description' => 'required|min:3',
        ]);

        $data = $request->all();
        $category = Category::find($id);

        $data['slug'] = Str::slug($request['name']);
        $category->update($data);

        return redirect()->route('category.index')->with('message', "Kategori $request->name berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id);
        $category = $data['name'];

        $subcategories = SubCategory::where('category_id', $id)->get();
        $SubCatsInTrash = SubCategory::onlyTrashed()->where('category_id', $id)->get();

        if ($subcategories->count() > 0) {
            foreach ($subcategories as $subcategory) {
                SubCategory::where('id', $subcategory['id'])->forceDelete();
            }
        }

        if ($SubCatsInTrash->count() > 0) {
            foreach ($SubCatsInTrash as $SubCat) {
                SubCategory::onlyTrashed()->where('id', $SubCat['id'])->forceDelete();
            }
        }

        $data->delete();
        return redirect()->route('category.index')->with('message', "Kategori $category berhasil dihapus ke tong sampah");
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        $title = 'Tongsampah Kategori';
        return view('admin.categories.trash', compact('title', 'categories'));
    }

    public function restore($id)
    {
        Category::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('category.index')->with('message', "Kategori berhasil dikembalikan");
    }

    public function delete($id)
    {
        $category = Category::onlyTrashed()->where('id', $id)->first();
        $subcategories = SubCategory::where('category_id', $id)->get();
        $SubCatsInTrash = SubCategory::onlyTrashed()->where('category_id', $id)->get();

        if ($subcategories->count() > 0) {
            foreach ($subcategories as $subcategory) {
                SubCategory::where('id', $subcategory['id'])->forceDelete();
            }
        }

        if ($SubCatsInTrash->count() > 0) {
            foreach ($SubCatsInTrash as $SubCat) {
                SubCategory::onlyTrashed()->where('id', $SubCat['id'])->forceDelete();
            }
        }

        Category::onlyTrashed()->where('id', $id)->forceDelete();

        return redirect()->route('category.trash')->with('message', "Kategori $category->name telah dihapus secara permanen");
    }
}
