<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\TaskRepository;
use App\Task;

class TaskController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
	{
    $tasks = Task::where('user_id', $request->user()->id)->get();

    return view('tasks.index', ['tasks' => $tasks,]);
	}

    public function store(Request $request)
	{
    $this->validate($request, [
        'name' => 'required|max:255',
    ]);

    $request->user()->tasks()->create([
        'name' => $request->name,
    ]);

    return redirect('/tasks');

    

    }
}
