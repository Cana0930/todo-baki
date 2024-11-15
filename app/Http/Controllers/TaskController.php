<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    function create()
    {
        $colors = Color::all();
        return view('tasks.create', compact('colors'));
    }
    
    // function store(Request $request)
    // {
    //     // dd($request->all());

    //     // バリデーション
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'contents' => 'nullable|string',
    //         'finish_date' => 'nullable|date',
    //         'color_id' => 'required|exists:colors,id', // color_idがcolorsテーブルに存在することを確認
    //         'photo' => 'nullable|image|max:10240',
    //     ]);
    
    //     // 新しいタスクを作成
    //     $task = new Task;
    //     $task->title = $request->title;
    //     $task->contents = $request->contents;
    //     $task->finish_date = $request->finish_date;
    //     $task->color_id = $request->color_id;
    
    //     // 写真がアップロードされた場合
    //     if ($request->hasFile('photo')) {
    //         $path = $request->file('photo')->store('photos', 'public');
    //         $task->photo = $path;
    //     }
    
    //     // タスクを保存
    //     $task->save();
    
    //     // タスク作成後、リダイレクト
    //     return redirect()->route('tasks.index')->with('success', 'タスクが作成されました');
    // }
    

    // function store(Request $request)
    // {
    //     // dd($request);
    //     $task = new Task;
    //     $task -> title = $request -> title;
    //     $task -> contents = $request -> contents;
    //     $task -> finish_date = $request -> finish_date;
    //     $task -> color_id = $request -> color_id;
    //     $task -> user_id = Auth::id();

    //     $task -> save();

    //     return redirect()->route('tasks.index');
    // }

    function edit($id)
    {
        $task = Task::find($id);

        return view('tasks.edit', ['task'=>$task]);
    }

    function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task -> title = $request -> title;
        $task -> contents = $request -> contents;
        $task -> save();

        return view('tasks.index', ['task'=>$task]);
    }

    function destroy($id)
    {
        $task = Task::find($id);
        $task -> delete();
        return redirect()->route('tasks.index');
    }
}