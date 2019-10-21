<?php

namespace App\Http\Controllers;

use App\Modules\Flash\Facades\Flash;
use App\Modules\TaskLists\{TaskList, TaskListRepository};
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    private $taskListRepository;

    public function __construct(TaskListRepository $taskListRepository)
    {
        $this->taskListRepository = $taskListRepository;
    }

    public function all()
    {
        $seo['title'] = 'Типовые задачи';

        $taskLists = $this->taskListRepository->all();

        return view('task-lists.all')->with(['seo' => $seo, 'taskLists' => $taskLists]);
    }

    public function form(TaskList $taskList = null)
    {
        $seo['title'] = ($taskList === null ?  'Добавление' : 'Редактирование').' типовой задачи';

        $taskLists = $this->taskListRepository->all();

        return view('task-lists.save')->with(['taskList' => $taskList, 'taskLists' => $taskLists, 'seo' => $seo]);
    }

    public function save(Request $request, TaskList $taskList = null)
    {
        $this->taskListRepository->save($request->all(), $taskList);

        Flash::success('Типовая задача успешно сохранена!');
        return redirect('task-lists');
    }

    public function delete(TaskList $taskList)
    {
        $this->taskListRepository->delete($taskList->id);

        Flash::success('Типовая задача успешно удалена!');
        return redirect('task-lists');
    }
}
