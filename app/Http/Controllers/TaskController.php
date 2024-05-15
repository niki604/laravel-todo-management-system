<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\EmployeesNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function todoList()
    {
        $result = Task::query();
        if(Auth::user()->type == 'employee') {
            $result->where('user_id', Auth::user()->id);
        }
        $result->get();
        $taskList = $result->get();

        return view('todos.list')->with([
            'user',
            'taskList' => $taskList
        ]);
    }

    public function addTodo()
    {
        $users = User::query()->where('type', '!=', 'admin')->get();
        return view('todos.add', compact('users'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:500'],
            'user_id' => ['nullable'],
            'status' => ['required']
        ]);

        $validated = $validator->validated();

        if($request->task_id) {
            $task = Task::findorFail($request->task_id);
            if(isset($task)) {
                $task->title = $request->title;
                $task->description = $request->description;
                $task->user_id = isset($request->user_id) ? $request->user_id : $task->user_id;
                $task->status = $request->status;

                if($task->user_id != $request->user_id) {
                    $task->notification = 'A new task has been assigned to you. Please click here to check.';
                }
                $task->save();
                toastr()->success('Todo Updated Successfully');
            }
        } else {
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'status' => $request->status,
                'notification' => 'A new task has been assigned to you. Please click here to check.'
            ]);
    
            toastr()->success('Todo Created Successfully');
        }
        
        return redirect()->route('todo-list');
    }

    public function destroy($id)
    {
        $task = Task::findorFail($id);
        if(isset($task)) {
            $task->delete($id);
            toastr()->success('Todo Deleted Successfully');
        }
        return redirect()->route('todo-list');
    }

    public function edit($id)
    {
        $task = Task::findorFail($id);
        $users = User::query()->where('type', '!=', 'admin')->get();
        if($task->user_id == Auth::user()->id) {
            return view('todos.add')->with([
                'users' => $users,
                'task' => $task
            ]);
        } else {
            abort(404);
        }
    }
}
