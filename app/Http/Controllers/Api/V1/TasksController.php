<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Resources\V1\TasksCollection;
use App\Http\Resources\V1\TasksResource;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{
    public function index() 
    {
        return new TasksCollection(Tasks::all());
    }

    public function show(Tasks $task)
    {
        return new TasksResource($task);
    }

    public function store(StoreTasksRequest $request, Tasks $task)
    {
        $validatedData = $request->validated();
        $validatedData['status'] = "pending";
        Tasks::create($validatedData);
        return response()->json("Task Created");
    }

    public function update(StoreTasksRequest $request, Tasks $task) 
    {
        $task->update($request->validated());
        return response()->json("Task Updated");
    }

    public function destroy(Tasks $task) 
    {
        $task->delete();
        return response()->json("Task Deleted");
    }

    public function updateStatus (Request $request, Tasks $task)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,in progress,completed',
        ]);
    
        $task->update(['status' => $validatedData['status']]);
    
        return response()->json(['message' => 'Status updated']);
    }
}
