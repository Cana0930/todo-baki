<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class Colorcontroller extends Controller
{
    function index()
    {
        $colors = Color::all();

        return view('tasks.create', compact('colors'));
    }
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'hex_code' => 'required|string|max:7',
    //     ]);

    //     Color::create([
    //         'name' => $request->name,
    //         'hex_code' => $request->hex_code,
    //     ]);

    //     return redirect()->route('tasks.index')->with('success', '色が追加されました！');
    // }
}
