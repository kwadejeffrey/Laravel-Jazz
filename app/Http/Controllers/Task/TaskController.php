<?php

namespace App\Http\Controllers\Task;

use Exception;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;

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
     * A method to create a new task and send it to python server for processing
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

            $created = Task::create($data);

            if ($created) {
                // $res = Http::post('http://127.0.0.1:5001/api/tasks', $data);
                $res = Http::post('http://host.docker.internal:5001/api/tasks', $data);


                if ($res->successful()) {
                    Notification::make()->title('Task created successfully')->body($res->json())->success()->send();
                    return response()->json(['success' => true, 'redirect' => route('task.index')]);
                }

                return response()->json(['success' => true, 'error' => 'Failed to process task in python server']);
            }

            return response()->json(['success' => false, 'error' => 'Failed to create task']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
            // return response()->json(['success' => false, 'error' => 'Failed to create task']);
        }
    }

    /**
     * Summary of markAsCompleted
     * A method to mark a task as completed
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
