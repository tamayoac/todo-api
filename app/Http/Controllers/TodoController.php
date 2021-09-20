<?php

namespace App\Http\Controllers;

use App\Todo;
use Carbon\Carbon;
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

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }
    public function index($user) 
    {
        $todos = $this->todo::where("user_id", $user)->get();
        
        return $this->successResponse($todos);
    }
    public function store(Request $request, $user)
    {
        
        $rules = [
            'date' => 'required',
            'description' => 'required'
        ];
        
        $this->validate($request, $rules);
        
        $todo = $this->todo::create([
            'user_id' => $user,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'description' => $request->description,
        ]);
       
        return $this->successResponse($todo, Response::HTTP_CREATED);
    }
    public function show($user, $todo)
    {   
        $todo = $this->todo::where("id", $todo)
                            ->where("user_id", $user)
                            ->first();

        return $this->successResponse($todo);
       
    }
    public function update(Request $request, $user, $todo)
    {   
        $this->validate($request, [
            'date' => 'required',
            'description' => 'required',
        ]);

        $todo = $this->todo::where("id", $todo)
                            ->where("user_id", $user)
                            ->first();

        if(is_null($todo)) {
            return $this->errorResponse("No Todo Relates to this user!", 404);
        }

        $todo->update($request->all());
       
        return $this->successResponse($todo);
    }
    public function destory($user, $todo) 
    {
        $todo = $this->todo::where("id", $todo)
                            ->where("user_id", $user)
                            ->first();
        if(is_null($todo)) {
            return $this->errorResponse("No Todo Relates to this user!", 404);
        }
        $todo->delete();

        return $this->successResponse($todo);
    }
}
