<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("app");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "task" => "required|min:3|max:25"
            ], [
                "task.required" => "Task has been required",
                "task.min" => "Task min 3 character",
                "task.max" => "Task max 25 character",
            ]);

            $data = [
                "task" => $request->input('task'),
            ];

            Todo::create($data);

            return redirect()->route("todo.index")->with("success", "Task has been created successfully");
        } catch (\Throwable $th) {
            return redirect()->route("todo.index")->with("error", "Task has been failed to create");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}