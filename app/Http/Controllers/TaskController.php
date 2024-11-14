<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    function create()
    {
        return view('tasks.create');
    }

    function store(Request $request)
    {
        // dd($request);
        $task = new Task;
        $task -> title = $request -> title;
        $task -> contents = $request -> contents;
        $task -> user_id = Auth::id();

        $task -> save();

        return redirect()->route('tasks.index');
    }

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