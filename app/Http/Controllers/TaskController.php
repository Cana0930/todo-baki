<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }
}
