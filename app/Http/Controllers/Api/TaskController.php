<?php

namespace App\Http\Controllers\Api;

use App\Task;
use Illuminate\Contracts\Validation\ValidationException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index () {
        return Task::paginate();
    }

    public function store (Request $request) {
        try{
            $this->validate($request, ['task' => 'required|max:255']);
            $task = new Task($request->only('task'));
            
            if ($task->save()) {
                return response(null, 201, ['Location' => \URL::route('task.show', ['task' => $task], false)]);
            }

            return response('', 400);
        }
        catch (ValidationException $e)
        {
            return response(['error'=> $e->errors()],422);
        }
        
    }

    public function show (Task $task) {
        return $task->toArray();
    }

    public function update (Request $request, Task $task) {
        try{
            $this->validate($request, ['task' => 'max:255', 'completed' => 'bool']);
            if ($task->update($request->all())) {
                return response(null, 202, ['Location' => \URL::route('task.show', ['task' => $task], false)]);
            }

            return response('', 400);
        }
        catch (ValidationException $e)
        {
            return response(['error'=> $e->errors()],422);
        }
    }

    public function destroy (Task $task) {
        if ($task->delete()) {
            return response(null, 202);
        }

        return response('', 400);
    }
}
