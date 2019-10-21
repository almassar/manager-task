<?php

namespace App\Http\Controllers;

use App\Modules\Comments\CommentRepository;
use App\Modules\Flash\Facades\Flash;
use App\Modules\Tasks\Task;
use App\Notifications\CommonNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function save(Request $request, Task $task)
    {
        $data = ['user_id' => Auth::user()->id, 'task_id' => $task->id, 'message' => $request->input('message')];
        $this->commentRepository->save($data);

        foreach($task->members() as $member)
        {
            $member->notify(new CommonNotification(
                'Новый комментарий', $request->input('message'), url('task-form/' . $task->id)));
        }

        Flash::success('Комментарий добавлен!');
        return redirect('task-form/'.$task->id);
    }


}
