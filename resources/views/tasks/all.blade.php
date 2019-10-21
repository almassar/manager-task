@extends('app')
@section('content')

@component('parts.panel-title', ['url' => url('task-form') ])
    @slot('title')
        {{ $seo['title'] }} - {{ $tasks->total() }}
    @endslot

    @slot('titleAddBtn')
        <span class="d-none d-sm-inline">Добавить</span> задачу
    @endslot
@endcomponent

@include('parts.flash')

<div class="container-fluid">
    <div class="panel-sub">
        <div class="row align-items-center">
            <div class="col-xl-15 col-lg-16 col-md-16">
                <ul>
                    <li class="d-none d-sm-block">
                        <a href="{{ url('task-lists') }}">
                            <span class="d-md-none d-xl-inline"><i class="fas fa-align-justify"></i></span>
                            Типовые задачи
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('tasks/old') }}">
                            <span class="d-md-none d-xl-inline"><i class="fas fa-check"></i></span>
                            Выполненные задачи
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('tasks/task-for-me') }}">
                            <span class="d-md-none d-xl-inline"><i class="fas fa-hiking"></i></span>
                            Задачи для меня
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('tasks/task-from-me') }}">
                            <span class="d-md-none d-xl-inline"><i class="fas fa-user"></i></span>
                            Задачи от меня
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-xl-8 offset-xl-1 col-lg-8 col-md-8">
                <form action="{{ url('task-search') }}" method="POST">
                    {!! csrf_field() !!}
                    <div class="input-group input-group-sm">
                        <input type="text" value="{{ $searchWord ?? '' }}" class="form-control" placeholder="Поиск задачи..." name="search_word" aria-label="Поиск">
                        <div class="input-group-append">
                            <button class="btn btn-success">
                                <span><i class="fas fa-search"></i></span>
                                <span class="d-md-none d-xl-inline">Найти</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <table class="table table-hover table-task">
        <thead>
            <tr>
                <th>#</th>
                <th>Задача</th>
                <th class="d-none d-md-table-cell">Создана</th>
                <th class="d-none d-md-table-cell" >Исполнитель</th>
                <th class="d-none d-md-table-cell">Срок</th>
                <th class="d-none d-md-table-cell">Статус</th>
                <th class="d-none d-md-table-cell"></th>
            </tr>
        </thead>

        @foreach($tasks as $task)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>

                @php
                    $taskClass = '';
                    $taskClass = $task->isOverdue() ? 'task-overdue' : '';
                    $taskClass = $task->is_finish ? 'task-finish' : $taskClass;
                @endphp

                <td class="{{ $taskClass }} ">
                    <a class="table-btn-edit"  title="Редактировать" href="{{ url('task-form/'.$task->id) }}">
                        {{ $task->name }}
                    </a>

                    @if(!empty($task->description))
                        <p style="background: #eee; margin-top: 5px; margin-bottom: 0; padding: 3px;">
                            {{ $task->description }}
                        </p>
                    @endif

                    <div class="d-md-none">
                        <b>Испольнитель:</b>
                        @foreach($task->executers as $executer)
                            {{ $executer->shortName() }}
                        @endforeach

                        <b>Статус:</b> {{ $task->status }}
                    </div>
                     <div class="d-md-none">
                        <b>Создана:</b> {{ $task->dateCreate() }}
                        <b>Срок:</b> {{ $task->date_execute }}
                    </div>
                </td>

                <td class="d-none d-md-table-cell">
                    {{ $task->dateCreate() }}
                </td>

                <td class="{{ Auth::user()->id == $task->executer_id ? 'task-executer' : '' }} d-none d-md-table-cell">
                    @foreach($task->executers as $executer)
                        <div>{{ $executer->shortName() }}</div>
                    @endforeach
                </td>

                <td class="d-none d-md-table-cell">
                    {{ $task->date_execute }}
                </td>

                <td class="d-none d-md-table-cell">
                    {{ $task->status }}
                </td>

                <td class="d-none d-md-table-cell">
                    @if($task->creater_id == Auth::user()->id)
                        <a class="table-btn-destroy" title="Удалить" href="{{ url('task-delete/'.$task->id) }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

{{ $tasks->links() }}
</div>
@stop