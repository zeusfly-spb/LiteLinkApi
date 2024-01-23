<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * @param Request $request
     * @return TaskResource
     */
    public function store(Request $request): TaskResource
    {
        return new TaskResource(Task::create($request->all()));
    }

    /**
     * @param $id
     * @return TaskResource
     */
    public function show($id): TaskResource
    {
        return new TaskResource(Task::find($id));
    }
}
