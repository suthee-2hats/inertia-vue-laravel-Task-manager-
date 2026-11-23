<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Task;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        return Inertia::render('tasks/Index', [
            'tasks' => fn () => Task::all(),
    
            'statistics' => fn () => [
                'total' => Task::count(),
                'completed' => Task::where('is_completed', true)->count(),
                'pending' => Task::where('is_completed', false)->count(),
            ],
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

public function update(Request $request, Task $task)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $task->update($validated);

    return redirect()->route('tasks.index');
}

public function toggle(Task $task)
{
    $task->update([
        'is_completed' => ! $task->is_completed,
    ]);

    return redirect()->route('tasks.index');
}


}

