<?php 

namespace App\Services;

use App\Repositories\TodoRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class TodoService 
{
    protected $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getAll()
    {
        $todo = $this->todoRepository->getAll();
        return $todo;
    }

    public function createTodo($data) : Object
    {
        $validator = Validator::make($data, [
            'title' => 'required|string'
        ]);

        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $newTodo = $this->todoRepository->createTodo($data);
        return $newTodo;
    }
}

?>