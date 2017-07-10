<?php

namespace App\Repositories;

use App\Task;
use Illuminate\Support\Facades\Auth;

class TaskRepository
{
    public function getAll()
    {
        return Task::orderBy('finished')->latest()->whereHas('user',function($query){
            $query->whereUserId(Auth::user()->id);
        });
    }

    public function getFilteredList($filter)
    {
        return Task::orderBy('finished')
            ->where('name', 'LIKE', "%$filter%")
            ->orWhere('description', 'LIKE', "%$filter%")
            ->latest()
            ->whereHas('user',function($query){
            $query->whereUserId(Auth::user()->id);
        });
    }
}