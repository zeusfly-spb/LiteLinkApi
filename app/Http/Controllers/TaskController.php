<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(TaskResource::collection(Task::all()));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json(new TaskResource(Task::create($request->all())));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id):JsonResponse
    {
        return response()->json(new TaskResource(Task::find($id)));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $task = Task::find($id);
        $task->update($request->all());
        return response()->json(new TaskResource($task));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        return response()->json(['deleted' => Task::find($id)->delete()]);
    }
}
