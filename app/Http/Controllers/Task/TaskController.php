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


    /**
     * Summary of create
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
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

    /**
     * Summary of markAsCompleted
     * @param mixed $id
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function markAsCompleted($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->is_done = true;
            $task->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to update task']);
        }
    }
}
