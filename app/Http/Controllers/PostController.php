<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\PostImages;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Storage;

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
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $imageFiles = $dom->getElementsByTagName('img');
        $arrImg = [];

        foreach ($imageFiles as $key => $imageFile) {
            $data = $imageFile->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list($e, $data) = explode(',', $data);
            $imageData[$key] = base64_decode($data);
            $uniqueName = date_timestamp_get(date_create());
            $imageName[$key] = "/post-image/" . date('timestamp') . time() . $key . $uniqueName . $imageFiles[$key]->getAttribute('data-filename');
            $path = public_path() . $imageName[$key];
            file_put_contents($path, $imageData[$key]);
            $imageFile->removeAttribute('src');
            $imageFile->setAttribute('src', $imageName[$key]);
            array_push($arrImg, substr($imageName[$key], 12));
        }

        // dd($arrImg);

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

        $getCurrentPost = Post::where('title', $request['title'])->first();

        for ($i = 0; $i < count($arrImg); $i++) {
            $insertImage['post_id'] = $getCurrentPost['id'];
            $insertImage['image_name'] = $arrImg[$i];

            PostImages::create($insertImage);
        }
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
        $title = "Edit " . $post['title'];
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
        $this->validate($request, [
            'title' => 'required|min:3',
            'category' => 'required|required',
            'subcategory' => 'required|required',
            'image' => 'mimes:jpg,jpeg,png',
            'article' => 'required|min:10'
        ]);

        $post = Post::find($id);
        $oldContent = $post['content'];

        $domOldArticle = new \DOMDocument();
        $domOldArticle->loadHTML($oldContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $findImages = $domOldArticle->getElementsByTagName('img');
        $oldImages = [];

        foreach ($findImages as $key => $findImage) {
            $data = $findImage->getAttribute('src');
            $data = explode('/', $data);
            array_push($oldImages, $data[2]);
        }

        $content = $request['article'];
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $imageFiles = $dom->getElementsByTagName('img');
        $arrImg = [];

        foreach ($imageFiles as $key => $imageFile) {
            $data = $imageFile->getAttribute('src');
            if (strpos($data, ';') === false) {
                continue;
            }
            list($type, $data) = explode(';', $data);
            list($e, $data) = explode(',', $data);
            $imageData[$key] = base64_decode($data);
            $uniqueName = date_timestamp_get(date_create());
            $imageName[$key] = "/post-image/" . date('timestamp') . time() . $key . $uniqueName . $imageFiles[$key]->getAttribute('data-filename');
            $path = public_path() . $imageName[$key];
            file_put_contents($path, $imageData[$key]);
            $imageFile->removeAttribute('src');
            $imageFile->setAttribute('src', $imageName[$key]);
            array_push($arrImg, substr($imageName[$key], 12));
        }

        $content = $dom->saveHTML();

        $arrayRemoveimage = array_diff($arrImg, $oldImages);
        if (sizeof($arrayRemoveimage) > 0) {
            for ($i = 0; $i > sizeof($arrayRemoveimage); $i++) {
                unlink(public_path("post-image/{$arrayRemoveimage[$i]}"));
            }
        }

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

        $imageName = $post['image'];

        if ($request->hasFile('image')) {
            if ($imageName != null || $imageName != 'univ-batam.jpg') {
                unlink(public_path("post-image/{$post['image']}"));
            }
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

        $post->update($inputData);
        return redirect()->route('post.index')->with('message', "Posting {$inputData['title']} berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('post.index')->with('message', "Posting {$post['title']} berhasil dihapus ke tong sampah");
    }

    public function trash()
    {
        $title = 'Tong Sampah Posting';
        $posts = Post::onlyTrashed()->get();
        return view('admin.posts.trash', compact('title', 'posts'));
    }

    public function restore(Request $request, $id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();
        Post::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('post.trash')->with('message', "Posting {$post['title']} berhasil dikembalikan");
    }

    public function delete($id)
    {
        $post = Post::onlyTrashed()->where('id', $id)->first();

        if (Storage::exists(public_path("post-image/{$post['image']}"))) {
            unlink(public_path("post-image/{$post['image']}"));
        }

        $domOldArticle = new \DOMDocument();
        $domOldArticle->loadHTML($post['content'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | libxml_use_internal_errors(true));
        $findImages = $domOldArticle->getElementsByTagName('img');
        $oldImages = [];

        foreach ($findImages as $key => $findImage) {
            $data = $findImage->getAttribute('src');
            $data = explode('/', $data);

            if (file_exists("post-image/" . $data[2])) {
                unlink(public_path("post-image/" . $data[2]));
            }
        }

        $listImages = PostImages::where('post_id', $id)->get();
        foreach ($listImages as $listImage) {
            if (Storage::exists(public_path("post-image/{$listImage['image_name']}"))) {
                unlink(public_path("post-image/{$listImage['image_name']}"));
            }
            PostImages::where('id', $listImage['id'])->forceDelete();
        }


        Post::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('post.trash')->with('message', "Posting {$post['title']} berhasil dihapus");
    }

    public function loadSubcategory($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->pluck('subname', 'id');
        return response()->json($subcategories);
    }

    public function uploadImage(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpeg,jpg,png'
        ]);

        $imageName = '';

        if ($request->hasFile('image')) {
            $imageName = time() . $request['image']->hashName();
            $pathImage = public_path('/post-image');
            $smallImage = Image::make($request['image']->path());
            // 250 mean size in px
            $smallImage->resize(800, 800, function ($const) {
                $const->aspectRatio();
            })->save($pathImage . '/' . $imageName);
        }

        $data['post_id'] = $id;
        $data['image_name'] = $imageName;

        PostImages::create($data);

        return asset("post-image/{$imageName}");
    }

    public function deleteImage(Request $request)
    {
        $pathLn = strlen(public_path('post-image')) - 33;
        $file_name = substr($request['src'], $pathLn);

        if (unlink(public_path("post-image/{$file_name}"))) {
            PostImages::where('image_name', $file_name)->forceDelete();
            return 'gambar telah dihapus';
        } else {
            return 'Telah terjadi kesalahan';
        }
    }
}
