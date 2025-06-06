<?php

// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Task;
use App\Models\TaskBot;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = TaskBot::with('customer')->latest()->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('tasks.create', compact('customers'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'priority' => 'required',
            'deadline' => 'nullable|date',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        TaskBot::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(TaskBot $task)
    {
        $customers = Customer::all();
        return view('tasks.edit', compact('task', 'customers'));
    }

    public function update(Request $request, TaskBot $task)
    {
        $request->validate([
            'title' => 'required',
            'priority' => 'required',
            'deadline' => 'nullable|date',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }
}
