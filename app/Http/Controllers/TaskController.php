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
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Получение списка всех задач",
     *     security={{"bearer_token": {}}},
     *     tags = {"Задачи"},
     *     @OA\Response(
     *         response=200,
     *         description="SUCCESS",
     *         @OA\JsonContent()
     *     ),
     *        @OA\Response(
     *       response=401,
     *        description="Unauthenticated"
     *    ),
     *    @OA\Response(
     *       response=400,
     *       description="Bad Request"
     *    ),
     *    @OA\Response(
     *       response=404,
     *       description="not found"
     *    ),
     *       @OA\Response(
     *           response=403,
     *           description="Forbidden"
     *       )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json(TaskResource::collection(Task::all()));
    }

    /**
     * @OA\Post(
     ** path="/api/tasks",
     *   tags={"Задачи"},
     *   summary="Создание новой задачи",
     *   security={{"bearer_token": {}}},
     *   @OA\Parameter(
     *       name="name",
     *       in="query",
     *       required=true,
     *       @OA\Schema(
     *            type="string"
     *       )
     *    ),
     *     @OA\Parameter(
     *        name="description",
     *        in="query",
     *        required=false,
     *        @OA\Schema(
     *             type="string"
     *        )
     *     ),
     *
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function store(Request $request): JsonResponse
    {
        return response()->json(new TaskResource(Task::create($request->all())));
    }

    /**
     * @OA\Get(
     ** path="/api/tasks/id",
     *   tags={"Задачи"},
     *   summary="Просмотр задачи",
     *   security={{"bearer_token": {}}},
     *   @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       @OA\Schema(
     *            type="integer"
     *       )
     *    ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function show($id):JsonResponse
    {
        return response()->json(new TaskResource(Task::find($id)));
    }

    /**
     * @OA\Put(
     ** path="/api/tasks/id",
     *   tags={"Задачи"},
     *   summary="Обновление параметров задачи",
     *   security={{"bearer_token": {}}},
     *     @OA\Parameter(
     *        name="id",
     *        in="path",
     *        required=true,
     *        @OA\Schema(
     *             type="integer"
     *        )
     *     ),
     *   @OA\Parameter(
     *       name="name",
     *       in="query",
     *       required=true,
     *       @OA\Schema(
     *            type="string"
     *       )
     *    ),
     *     @OA\Parameter(
     *        name="description",
     *        in="query",
     *        required=false,
     *        @OA\Schema(
     *             type="string"
     *        )
     *     ),
     *
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function update(Request $request, $id): JsonResponse
    {
        $task = Task::find($id);
        $task->update($request->all());
        return response()->json(new TaskResource($task));
    }

    /**
     * @OA\Delete(
     ** path="/api/tasks/id",
     *   tags={"Задачи"},
     *   summary="Удаление задачи",
     *   security={{"bearer_token": {}}},
     *   @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       @OA\Schema(
     *            type="integer"
     *       )
     *    ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function destroy($id): JsonResponse
    {
        return response()->json(['deleted' => Task::find($id)->delete()]);
    }
}
