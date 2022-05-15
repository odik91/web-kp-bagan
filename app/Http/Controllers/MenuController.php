<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'List Menu';
        $menus = Menu::orderBy('id', 'asc')->get();
        return view('admin.menus.index', compact('title', 'menus'));
    }
}
