<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use app\Models\menu;
use Illuminate\Support\Facades\Redirect;

class MenuController extends Controller
{
    public function create_menu(){
        return view('admin/create_menu');
    }

    public function store_menu(Request $request){
        $request->validate([
            'nama_menu' => 'required',
            'harga_menu' => 'required',
            'deskripsi' => 'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->nama_menu . '.' . $file->getClientOriginalExtension();
    
        Storage::disk('local')->put('public/' . $path, file_get_contents($file));
    
        Menu::create([
            'nama_menu' => $request->nama_menu,
            'harga_menu' => $request->harga_menu,
            'deskripsi' => $request->deskripsi,
            'image' => $path
        ]);

        return Redirect::route('create_menu');
    }  
}
