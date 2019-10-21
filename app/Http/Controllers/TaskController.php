<?php

namespace App\Http\Controllers;

use App\Modules\Flash\Facades\Flash;
use App\Modules\TaskLists\TaskListRepository;
use App\Modules\Tasks\{TaskRepository, Task};
use App\Modules\Users\UserRepository;
use App\Notifications\CommonNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private $taskRepository;
    private $taskListRepository;
    private $userRepository;

    const COUNT_PAGE_TASK = 20;

    public function __construct(TaskRepository $taskRepository, UserRepository $userRepository, TaskListRepository $taskListRepository)
    {
        $this->taskRepository  = $taskRepository;
        $this->userRepository  = $userRepository;
        $this->taskListRepository  = $taskListRepository;
    }

    public function all($slug = 'execute')
    {
        if ($slug == 'old')
        {
            $seo['title'] = 'Выполненые задачи';
            $tasks = $this->taskRepository->where(['is_finish' => 1])->orderBy('date_execute')->paginate();
        }

        if ($slug == 'task-for-me')
        {
            $seo['title'] = 'Задачи для меня';
            $tasks = $this->taskRepository->getTaskForMe()->paginate();
        }

        if ($slug == 'task-from-me')
        {
            $seo['title'] = 'Задачи от меня';
            $tasks = $this->taskRepository->where(['creater_id' => Auth::user()->id])->orderBy('date_execute')->paginate();
        }

        if ($slug == 'execute')
        {
            $seo['title'] = 'Не выполненные задачи';
            $tasks = $this->taskRepository->where(['is_finish' => 0])->orderBy('date_execute')->paginate(self::COUNT_PAGE_TASK);
        }

        if ($slug == 'all')
        {
            $seo['title'] = 'Задачи';
            $tasks = $this->taskRepository->orderBy('date_execute')->paginate();
        }

        return view('tasks.all')->with(['seo' => $seo ?? '', 'tasks' => $tasks ?? '']);
    }

    public function form(Task $task = null)
    {
        $seo['title'] = ($task === null ?  'Добавление' : 'Редактирование').' задачи';
        $users  = $this->userRepository->where(['is_client' => 0])->orderBy('name')->get();

        $taskLists =  $this->taskListRepository->all();

        return view('tasks.save')->with(['task' => $task, 'taskLists' => $taskLists, 'users' => $users, 'seo' => $seo]);
    }

    public function save(Request $request, Task $task = null)
    {
        $isNewTask = $task == null;

        if (!$isNewTask && ($task->is_finish !== $request->input('is_finish')) ){
            foreach ($task->members() as $member) {
                $member->notify(new CommonNotification('Задача выполнена', $request->input('name'), url('task-form/' . $task->id)));
            }
        }

        $task = $this->taskRepository->save($request->all(), $task);
        $task->executers()->sync($request->input('executers'));

        if ($isNewTask) {
            foreach ($task->members() as $member) {
                $member->notify(new CommonNotification('Новая задача', $request->input('name'), url('task-form/' . $task->id)));
            }
        }


        Flash::success('Задача успешно сохранена!');
        return redirect('tasks');
    }

    public function delete(Task $task)
    {
        if($task->creater_id !== Auth::user()->id)
            abort(403);

        $this->taskRepository->delete($task->id);

        Flash::success('Задача успешно удалена!');
        return redirect('tasks');
    }

    public function search(Request $request)
    {
        $seo['title'] = 'Поиск задач';

        $tasks = $this->taskRepository->search($request->input('search_word'));

        return view('tasks.all')->with(['seo' => $seo ?? '', 'tasks' => $tasks]);
    }
}
