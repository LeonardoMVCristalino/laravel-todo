<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::orderBy("id","desc")->paginate(10);
        return $tasks;
    }

    public function store(StoreTaskRequest $request) {
        // validar datos
        // $validatedData = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'is_completed' => 'sometimes|boolean'
        // ]);
        // se modifico por un request (validador de entrada de datos de un controller)

        // crear tarea
        $task = Task::create($request->validated());

        // retornar respuesta exitosa
        return response()->json([
            "message" => "Task created successfully",
            "data" => $task,
        ], 201);
    }

    public function show($id) {
        $task = Task::find($id);
        return response()->json([
            "message" => "Task fetched successfully",
            "data" => $task,
        ]);
    }

    public function update(UpdateTaskRequest $request, $id) {
        $task = Task::find($id);
        $task->update($request->validated());
        return response()->json([
            "message" => "Task updated successfully",
            "data" => $task,
        ]);
    }

    public function destroy($id) {
        $task = Task::find($id);
        $task->delete();
        return response()->json([
            "message" => "Task deleted successfully",
            "data" => $task,
        ]);
    }
}
