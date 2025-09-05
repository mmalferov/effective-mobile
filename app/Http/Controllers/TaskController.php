<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Enums\TaskStatus;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController
{
    private const int TASK_PER_PAGE = 50;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::paginate(self::TASK_PER_PAGE));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $validated = $request->validated();

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'status' => TaskStatus::PENDING->value,
        ]);

        return response()->json([
            'data' => ['id' => $task->id],
            'error' => null
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);

        return $task
            ? response()->json([
                'data' => new TaskResource($task),
                'error' => null
            ])
            : response()->json([
                'data' => null,
                'error' => [
                    'message' => sprintf('Task with the ID %s was not found', $id),
                    'code' => 404,
                ],
            ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'data' => null,
                'error' => [
                    'code' => 404,
                    'message' => sprintf('Task with the ID %s not found', $id),
                ]
            ], 404);
        }

        $task->update($request->validated());

        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'data' => null,
                'error' => ['message' => sprintf('Task with the ID %s was not found', $id), 'code' => 404]
            ], 404);
        }

        $task->delete();
        return response()->json(null, 204);
    }
}
