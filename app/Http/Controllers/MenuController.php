<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Submenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Menu';
        $menus = Menu::orderBy('id', 'asc')->get();
        return view('admin.menus.index', compact('title', 'menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Menu';
        return view('admin.menus.createMenu', compact('title'));
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
            'menu' => 'required|min:3|unique:menus',
            'icon' => 'required|min:5',
        ]);

        $route = $request['route'];
        $menu = ucwords($request['menu']);

        if ($route == null) {
            $route = '';
        }

        $data = $request->all();
        $data['menu'] = $menu;
        $data['route'] = $route;
        Menu::create($data);

        return redirect()->back()->with('message', "Menu $request->menu berhasil dibuat");
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
        $menu = Menu::where('id', $id)->first();
        $title = 'Edit Menu';
        return view('admin.menus.edit', compact('menu', 'title'));
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
            'menu' => 'required|min:3|unique:menus',
            'icon' => 'required|min:5',
        ]);

        $route = $request['route'];
        if ($route == null) {
            $route = '';
        }

        $menu = Menu::find($id);
        $data = $request->all();
        $data['route'] = $route;
        $menu->update($data);

        return redirect()->route('menu.index')->with('message', "Menu $request->menu berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menuName = $menu['menu'];

        $submenus = Submenu::where('menu_id', $menu['id'])->get();

        foreach ($submenus as $submenu) {
            Submenu::find($submenu['id'])->forceDelete();
        }

        $menu->delete();
        return redirect()->route('menu.index')->with('message', "Menu $menuName berhasil dihapus ke tong sampah");
    }

    public function trash()
    {
        $title = 'Tong Sampah Menu';
        $menus = Menu::onlyTrashed()->get();
        return view('admin.menus.trash', compact('title', 'menus'));
    }

    public function restore($id)
    {
        $menu = Menu::onlyTrashed()->where('id', $id)->first();
        Menu::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('menu.trash')->with('message', "Menu $menu->menu berhasil kembalikan");
    }

    public function delete($id)
    {
        $menu = Menu::onlyTrashed()->where('id', $id)->first();
        $submenus = Submenu::where('menu_id', $menu['id']);

        if ($submenus->count() > 0) {
            foreach ($submenus as $submenu) {
                Submenu::onlyTrashed()->where('id', $submenu['id'])->forceDelete();
            }
        }

        Menu::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('menu.trash')->with('message', "Menu $menu->menu telah dihapus secara permanen");
    }
}
