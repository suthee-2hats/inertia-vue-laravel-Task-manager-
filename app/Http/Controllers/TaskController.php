<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return Inertia::render('tasks/Index', [
            'tasks' => $tasks,
        ]);
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    Task::create($validated);

    return redirect()->route('tasks.index');
}
}

