<?php

namespace App\Http\Controllers;

use App\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function index() 
    {
        $todos = Todo::all();
        
        return response()->json($todos);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'description' => 'required'
        ]);
        
        $todo = Todo::create([
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'description' => $request->description,
        ]);
       
        return response()->json($todo, Response::HTTP_OK);
    }
    public function destory($id) 
    {
        $todo = Todo::find($id);
        $todo->delete();

        return response()->json("Successfully Deleted", Response::HTTP_OK);
    }
}
