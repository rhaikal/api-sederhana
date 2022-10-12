<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoService;
use Exception;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function getListTodo()
    {
        try {
            $result = $this->todoService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result, (isset($result['status']) ? $result['status'] : 200));
    }

    public function createTodo(Request $request)
    {
        $data = $request->only('title');
        $result = ['status' => 201];

        try {
            $result['data'] = $this->todoService->createTodo($data);
        } catch (Exception $e) {
            $result = [
                'status' => 422,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }
}