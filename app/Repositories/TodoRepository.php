<?php 

namespace App\Repositories;

use App\Models\Todo;

class TodoRepository 
{
    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function getAll() : Object
    {
        $listTodo = $this->todo->get();
        return $listTodo;
    }

    public function createTodo(array $data) : Object
    {
        $newTodo = new $this->todo;
        $newTodo->title = $data['title'];
        $newTodo->save();

        return $newTodo->fresh();
    }
}
?>