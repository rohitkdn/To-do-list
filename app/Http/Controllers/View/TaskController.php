<?php

namespace App\Http\Controllers\View;

use App\Task;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::orderBy('updated_at','desc')->get();
        $deleted = Task::onlyTrashed()->get();
        return view('tasks', compact('tasks', 'deleted'));
    }
//    
//    public function create(){
//        return view('create');
//    }

//    public function show($id){
//        $task = Task::find($id);
//        if (!$task){
//            abort(404);
//        }
//
//        return view('show', compact('task'));
//    }
//


    public function store(Request $request){
        $this->validate($request, ['task' => 'required|max:255']);
        $task = new Task;
        $task->task = $request->input('task');
        $task->user()->associate(Auth::user());
        $task->save();

        return redirect('/');
    }

    public function destroy(Task $task){
        $this->authorize('own_task', $task);
        if (!$task->delete()) {
            return redirect('/')->withErrors(['error' => 'Cannot delete '.$task->task]);
        }

        return redirect('/');
    }

    public function restore($task){
        $task = Task::withTrashed()->find($task);

        if (!$task) {
            abort(404);
        }


        $this->authorize('own_task', $task);

        if (!$task->restore()){
            return redirect('/')->withErrors(['error' => 'Cannot restore '.$task->task]);
        }
        return redirect('/');
    }

    public function update(Task $task, Request $request){
        $this->validate($request, ['task' => 'min:1|max:255']);
        if ($request->has('task')) {
            $this->authorize('own_task', $task);
        }
        if (!$task->update($request->all() + ['completed' => 'off'])){
            return redirect('/')->withErrors(['error' => 'Cannot update '.$task->task]);
        }
        return redirect('/');
    }
}
