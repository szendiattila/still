<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests\TaskRequest;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class TaskController extends Controller
{
    protected $taskRepo;
    /**
     * TaskController constructor.
     * @param TaskRepository $taskRepo
     */
    public function __construct(TaskRepository $taskRepo)
    {
        $this->middleware('auth');
        $this->taskRepo = $taskRepo;
    }

    /**
     * list tasks
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $filter = request('search');

        $query = $filter
        ? $this->taskRepo->getFilteredList($filter)
        : $this->taskRepo->getAll();

        $isHidden = Cookie::get('is-hidden');

        $query = $isHidden ? $query->where('finished', '<>', true) : $query;

        $tasks = $query->get();

        return view('task.index', compact('tasks'));
    }

    /**
     * creates a task
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
     * updates a specific task
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
     * deletes a specific task
     * @param Task $task
     * @return Task|int
     * @throws \Exception
     */
    public function destroy(Task $task)
    {
        return $task->delete() ? $task : 0;
    }

    /**
     * updates finish attribute on a specific task
     * @param Task $task
     * @return Task
     */
    public function toggleFinished(Task $task)
    {
        $data = $task->finished ? false : true;

        $task->update(['finished' => $data]);

        return $task;
    }

    /**
     * set cookie for finished tasks visibility
     * @return $this
     */
    public function toggleVisibility()
    {
        if(Cookie::has('is-hidden') && Cookie::get('is-hidden') !== 0) {
            return response('visibility cookie has been set')->cookie(
                'is-hidden', 0, 60*24*256
            );
        }
        return response('visibility cookie has been set')->cookie(
            'is-hidden', 1, 60*24*256
        );
    }

    /**
     * get the required data for store or update
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
