<?php
namespace App\Repositories\Todo;

use App\Todo;
use Carbon\Carbon;
use App\Repositories\Todo\TodoInterface;

class TodoRepository implements TodoInterface
{
    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }
    public function getAll($user)
    {
        return $this->todo->where('user_id', $user)->get();
    //     return $this->todo->where('user_id', $user)
    //                         ->orderBy('date')
    //                         ->get()
    //                         ->groupBy(function($item) {
    //         return $item->date;
    //    });

    }
    public function getById($user, $todo)
    {
        $todo = $this->todo
                    ->where("id", $todo)
                    ->where("user_id", $user)
                    ->first();

        return $todo;
    }
    public function create(array $attributes, $user)
    {   
        $todo = $this->todo->create([
            'user_id' => $user,
            'datetime' => date('Y-m-d H:i:s', strtotime($attributes['date'] . $attributes['time'])),
            'title' => $attributes['title'],
        ]);

        return $todo;
    }
    public function update(array $attributes, $user, $todo)
    {

         $todo = $this->todo
                    ->where("id", $todo)
                    ->where("user_id", $user)
                    ->first();

        $todo->update($attributes);
       
        return $todo;
    }
    public function delete($user, $todo)
    {
        $todo = $this->todo::where("id", $todo)
                    ->where("user_id", $user)
                    ->first();
        
        $todo->delete();

        return true;
    }
    public function overHaulStatus($user, $todo)
    {
        $todo = $this->todo::where("id", $todo)
                    ->where("user_id", $user)
                    ->first();
        
        if($todo->active == 1) {
            $todo->update([
                'active' => 0
            ]);
        } else {
            $todo->update([
                'active' => 1
            ]);
        }
       
        return true;
    }
}