<?php

namespace App\Http\Controllers\Task;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    //

    public function index()
    {
        $tasks = Task::latest()->paginate(5);
        return view('Task.index', [
            'tasks' => $tasks
        ]);
    }
}
