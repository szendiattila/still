<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Repositories\TaskRepository;
use App\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param TaskRepository $taskRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(TaskRepository $taskRepo)
    {
        $filter = request('search');

        $tasks = $filter
        ? $taskRepo->getFilteredList($filter)->get()
        : $taskRepo->getAll()->get();

        return view('task.index', compact('tasks'));
    }

    /**
     * @param TaskRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(TaskRequest $request)
    {
        $data = $this->getTaskData($request);

        $task = Task::create($data);

        return view('task.html-to-add', compact('task'));
    }

    /**
     * @param Task $task
     * @param TaskRequest $request
     * @return Task
     */
    public function update(Task $task, TaskRequest $request)
    {
        $data = $this->getTaskData($request);

        $task->update($data);

        return $task;
    }

    /**
     * @param Task $task
     * @return Task|int
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        return $task->delete() ? $task : 0;
    }

    public function toggle(Task $task)
    {
        $data = $task->finished ? false : true;

        $task->update(['finished' => $data]);

        return $task;
    }

    /**
     * @param TaskRequest $request
     * @return array
     */
    private function getTaskData(TaskRequest $request)
    {
        $request->request->add(['user_id' => Auth::user()->id]);

        $data = $request->only(['name', 'description', 'user_id']);
        return $data;
    }
}
