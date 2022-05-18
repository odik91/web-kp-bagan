<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use Illuminate\Http\Request;

class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Submenu';
        $submenus = Submenu::orderBy('id', 'asc')->get();
        return view('admin.submenus.index', compact('title', 'submenus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Submenu';
        return view('admin.submenus.create', compact('title'));
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
            'menu_id' => 'required',
            'title' => 'required|min:3',
            'route' => 'required|min:3',
            'icon' => 'required',
            'active' => 'required'
        ]);

        $subMenu = ucwords($request['title']);

        $data = $request->all();
        $data['title'] = $subMenu;
        Submenu::create($data);

        return redirect()->route('submenu.index')->with('message', "Submenu $subMenu berhasil dibuat");
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
        $title = 'Edit Submenu';
        $submenu = Submenu::where('id', $id)->first();

        return view('admin.submenus.edit', compact('title', 'submenu'));
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
            'menu_id' => 'required',
            'title' => 'required|min:3',
            'route' => 'required|min:3',
            'icon' => 'required',
            'active' => 'required'
        ]);

        $submenu = Submenu::find($id);
        $data = $request->all();
        $submenu->update($data);

        return redirect()->route('submenu.index')->with('message', "Submenu $request->title berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $submenu = Submenu::find($id);
        $submenuName = $submenu['title'];

        $submenu->delete();
        return redirect()->route('submenu.index')->with('message', "Submenu $submenuName berhasil dihapus ke tong sampah");
    }

    public function trash()
    {
        $title = 'Tong Sampah Submenu';
        $submenus = Submenu::onlyTrashed()->get();
        return view('admin.submenus.trash', compact('title', 'submenus'));
    }

    public function restore($id)
    {
        $submenu = Submenu::onlyTrashed()->where('id', $id)->first();
        Submenu::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('submenu.trash')->with('message', "Submenu $submenu->title berhasil dikembalikan");
    }

    public function delete($id)
    {
        $submenu = Submenu::onlyTrashed()->where('id', $id)->first();
        Submenu::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('submenu.trash')->with('message', "Submenu $submenu->menu telah dihapus secara permanen");
    }
}
