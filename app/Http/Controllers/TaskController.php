<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Color;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    function index(Request $request)
{
    // 現在ログインしているユーザーのタスクを取得
    $query = Task::where('user_id', Auth::id());

    // ソート条件をリクエストから取得
    $sort = $request->input('sort');

    // ソート条件に応じた並び替え処理
    switch ($sort) {
        case 'created_at_asc':
            $query->orderBy('created_at', 'asc');
            break;
        case 'created_at_desc':
            $query->orderBy('created_at', 'desc');
            break;
        case 'finish_date_asc':
            $query->orderBy('finish_date', 'asc');
            break;
        case 'finish_date_desc':
            $query->orderBy('finish_date', 'desc');
            break;
        case 'color':
            $query->join('colors', 'tasks.color_id', '=', 'colors.id')
                  ->orderBy('colors.color_code', 'asc')
                  ->select('tasks.*');
            break;
        default:
            $query->orderBy('created_at', 'desc'); // デフォルトの並び替え
            break;
    }

    // 最終的なタスクデータを取得
    $tasks = $query->get();

    return view('tasks.index', compact('tasks', 'sort'));
}

    function create()
    {
        $colors = Color::all();
        return view('tasks.create', compact('colors'));
    }
    
    function store(Request $request)
    {
        // dd($request->all());

        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'contents' => 'nullable|string',
            'finish_date' => 'nullable|date',
            'color_id' => 'required|exists:colors,id', // color_idがcolorsテーブルに存在することを確認
            'image_at' => 'nullable|image|max:10240',
        ]);
    
        // 新しいタスクを作成
        $task = new Task;
        $task->title = $request->title;
        $task->contents = $request->contents ?? 'Default content';
        // $task->image_at = $request->image_at ?? 'default_image.jpg';
        $task->finish_date = $request->finish_date;
        $task->color_id = $request->color_id;
        $task->user_id = Auth::id();
    
        // 写真がアップロードされた場合
        if ($request->hasFile('image_at')) {
            $path = $request->file('image_at')->store('image_at', 'public');
            $task->image_at = $path;
        } else {
            $task->image_at = 'img/noimage.png';
        }
    
        // タスクを保存
        $task->save();
    
        // タスク作成後、リダイレクト
        return redirect()->route('tasks.index');
    }

    function edit($id)
    {
        $task = Task::find($id);
        $colors = Color::all();

        return view('tasks.edit', ['task'=>$task, 'colors'=>$colors]);
    }

    function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task -> title = $request -> input('title');
        $task -> contents = $request -> input('contents');
        $task -> finish_date = $request -> input('finish_date');
        $task -> color_id = $request -> input('color_id');

        //ファイルのアップロード処理
        if($request -> hasFile('image_at')){
            if($task->image_at){
                Storage::delete($task->image_at);
            }

            $path = $request -> file('image_at')->store('images', 'public');
            $task->image_at = $path;
        }
        $task -> save();

        $tasks = Task::all();

        return view('tasks.index', ['tasks' => $tasks]);
    }

    function destroy($id)
    {
        $task = Task::find($id);
        $task -> delete();
        return redirect()->route('tasks.index');
    }

    function share(Request $request)
    {
        $tasks = Task::with('user', 'color')->get();
    
        // ユーザーごとにタスクをグループ化
        $groupedTasks = $tasks->groupBy('user_id');
    
        return view('tasks.share', compact('groupedTasks'));
    }
    


}