<?php

namespace App\Repositories;

use App\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository
{
    public function sortedList()
    {
        return Task::orderBy('finished')->latest()->whereHas('user',function($query){
            $query->whereUserId(Auth::user()->id);
        });
    }
}