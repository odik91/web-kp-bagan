<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Image;

class PostController extends Controller
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
        $title = 'List Posting';
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.posts.index', compact('title', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Posting';
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.posts.create', compact('title', 'categories'));
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
            'title' => 'required|min:3',
            'category' => 'required|required',
            'subcategory' => 'required|required',
            'image' => 'required|mimes:jpg,jpeg,png',
            'article' => 'required|min:10'
        ]);

        $content = $request['article'];
        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFiles = $dom->getElementsByTagName('img');
        $arrImg = [];

        foreach ($imageFiles as $key => $imageFile) {
            $data = $imageFile->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list($e, $data) = explode(',', $data);
            $imageData[$key] = base64_decode($data);
            $imageName[$key] = "/post-image/" . date('timestamp') . time() . $key . $request['image']->hashName() . $imageFiles[$key]->getAttribute('data-filename');
            // $path = public_path() . $imageName[$key];
            // file_put_contents($path, $imageData[$key]);
            // $imageFile->removeAttribute('src');
            // $imageFile->setAttribute('src', $imageName[$key]);
            array_push($arrImg, substr($imageName[$key], 12));
        }

        dd($arrImg);


        $content = $dom->saveHTML();

        $imageName = '';

        if ($request->hasFile('image')) {
            $imageName = time() . $request['image']->hashName();
            $pathImage = public_path('/post-image');
            $smallImage = Image::make($request['image']->path());
            // 250 mean size in px
            $smallImage->resize(1024, 1024, function ($const) {
                $const->aspectRatio();
            })->save($pathImage . '/' . $imageName);
        }

        $inputData['title'] = ($request['title']);
        $inputData['slug'] = Str::slug($request['title']);
        $inputData['category_id'] = $request['category'];
        $inputData['sub_category_id'] = $request['subcategory'];
        $inputData['content'] = $content;
        $inputData['image'] = $imageName;
        $inputData['author'] = auth()->user()->id;
        $inputData['year'] = date("Y");
        $inputData['month'] = date("m");

        Post::create($inputData);
        return redirect()->route('post.index')->with('message', "Posting $request->title berhasil dibuat");
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
        $post = Post::find($id);
        $title = "Edit" . $post['title'];
        $categories = Category::orderBy('name', 'asc')->get();
        $subcategories = SubCategory::where('category_id', $post['category_id'])->get();
        return view('admin.posts.edit', compact('title', 'post', 'categories', 'subcategories'));
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

    public function loadSubcategory($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->pluck('subname', 'id');
        return response()->json($subcategories);
    }
}
