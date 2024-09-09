<?php

namespace App\Http\Controllers\Task;

use Exception;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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


    public function store()
    {
        return view('Task.create');
    }


    public function create(Request $request)
    {
        try {

            $data = $request->validate([
                'task_name' => 'required',
                'task_description' => 'required',
                'is_done' => 'bool',
            ]);

            // dd($data);
            Task::create($data);

            return response()->json(['success' => true, 'redirect' => route('task.index')]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to create task']);
        }
    }
}
