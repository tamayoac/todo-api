<?php

namespace App\Http\Controllers;

use App\Repositories\Todo\TodoRepository;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use ApiResponser;

    private $todo; 

    public function __construct(TodoRepository $todo)
    {
        $this->todo = $todo;
    }
    public function index($user) 
    {        
        return $this->successResponse($this->todo->getAll($user));
    }
    public function store(Request $request, $user)
    {
        
        $rules = [
            'date' => 'required',
            'time' => 'required',
            'title' => 'required'
        ];
        
        $this->validate($request, $rules);
        
        return $this->successResponse($this->todo->create($request->all(), $user), Response::HTTP_CREATED);
    }
    public function show($user, $todo)
    {   
        return $this->successResponse($this->todo->getById($user, $todo));
    }
    public function update(Request $request, $user, $todo)
    {   
        $rules = [
            'date' => 'required',
            'description' => 'required'
        ];

        $this->validate($request, $rules);
       
        return $this->successResponse($this->todo->update($request->all(), $user, $todo));
    }
    public function destory($user, $todo) 
    {
        return $this->successResponse($this->todo->delete($user, $todo));
    }
    public function updateStatus($user, $todo) 
    {
        return $this->successResponse($this->todo->overHaulStatus($user, $todo));
    }
}
