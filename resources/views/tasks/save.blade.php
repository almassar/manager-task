@extends('app')
@section('content')

@component('parts.panel-title')
    @slot('title')
            {{  $seo['title'] }}
    @endslot
@endcomponent

@include('parts.flash')

<div class="container-fluid">
<div class="row">
    <div class="col-xl-11 col-lg-15 col-md-18">
        <form class="form-well" action="{{ url('task-save/'.optional($task)->id) }}" method="post">
            {!! csrf_field() !!}

            <div class="row">
                <div class="col-19">
                    <div class="form-group">
                        <label for="name">Задача</label>
                        <input type="text" class="form-control form-control-sm" name="name" value="{{ optional($task)->name }}" required id="name">
                    </div>
                </div>

                <div class="col-5">
                    <div class="form-group">
                        <label for="date_execute">Срок</label>
                        <input type="text" class="form-control datepicker form-control-sm" autocomplete="off" name="date_execute" value="{{ optional($task)->date_execute }}" required id="date_execute">
                    </div>
                  </div>
            </div>

            <div class="task-form-info">
                <b>Создана:</b> {{ $task == null ? date("d.m.Y") : $task->dateCreate() }}
                <b style="margin-left: 15px;">Автор:</b> {{ $task == null ? Auth::user()->name : optional($task)->creater->name }}
            </div>
            <input type="hidden" name="creater_id" value="{{$task == null ? Auth::user()->id : optional($task)->creater_id }}" id="creater_id">

            <div class="row">
                <div class="col-24">
                    <div class="form-group">
                        <label for="description">Описание задачи</label>
                        <textarea id="description" class="form-control" style="font-size: 14px;" rows="3" name="description">{{ optional($task)->description }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="task_list_id">Типовая задача</label>

                        <select name="task_list_id" id="task_list_id" class="form-control form-control-sm">
                            @foreach($taskLists as $taskList)
                                <option value="{{ $taskList->id }}" {{ optional($task)->task_list_id == $taskList->id ? 'selected' : '' }}>
                                    {{ $taskList->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12">

                    <div class="form-group">
                       <label for="user">Ф.И.О. ответственного</label>

                        <select name="user_id" id="user" required class="form-control form-control-sm">
                            <option selected disabled value=''>Выберите сотрудника </option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ optional($task)->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="executer_id">Ф.И.О. исполнителя</label>
                    <div class="input-group" style="margin-bottom: 15px;">


                        <select name="executer_id" id="executer_id" {{ $task == null ? 'required' : '' }} class="form-control form-control-sm">
                            <option value="">Выберите сотрудника </option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ optional($task)->executer_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button id="btn-add-executer" type="button" class="btn btn-sm btn-info" style="font-weight: 500; padding: auto 20px !important;">+</button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <b>Список исполнителей</b>
                        <ul class="list-add-executer">
                            @if($task !== null)
                                @foreach($task->executers as $executer)
                                    <li id="{{ 'executerId' .$executer->id }}">
                                        {{ $executer->name }}

                                        <a href="#" id="{{ $executer->id}}" class="float-right executer-delete"><i class="fas fa-trash"></i></a>
                                        <input id="{{ "inputExecuterId".$executer->id }}" type="hidden" name="executers[]" value="{{ $executer->id }}">
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" value="1" name="is_finish" {{ optional($task)->is_finish == 1 ? 'checked' :'' }} id="is_finish">
                <label for="is_finish" class="form-check-label" >Выполнено</label>
            </div>

            <button class="btn btn-success btn-sm"><span><i class="fas fa-check"></i></span> Сохранить</button>

        </form>
    </div>

    @if($task !== null)
        <div class="col-xl-11 offset-xl-2">
            <h5 class="title-page" style="font-size: 16px">Комментарий</h5>
            <ul class="list-comment">
            @forelse($task->comments as $comment)
                <li>
                    <div>
                        <b>{{ $comment->user->shortName() }}</b>
                        {{ $comment->created_at }}
                    </div>

                    <div style="background: #eee; padding: 5px;">
                        {{ $comment->message }}
                    </div>


                </li>
            @empty
                Комментарий нет!
            @endforelse
            </ul>

            <form class="form-well" action="{{ url('comment-save/'.optional($task)->id) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="message">Комментарий</label>
                    <textarea name="message" id="message" class="form-control form-control-sm" required></textarea>
                </div>

                <button class="btn btn-primary btn-sm"><span><i class="fas fa-share"></i></span> Отправить</button>
            </form>

        </div>
    @endif
</div>
</div>

@stop
