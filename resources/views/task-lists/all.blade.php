@extends('app')
@section('content')

@component('parts.panel-title', ['url' => url('task-list-form') ])
    @slot('title')
        {{ $seo['title'] }} - {{ $taskLists->count() }}
    @endslot

    @slot('titleAddBtn')
        <span class="d-none d-sm-inline">Добавить</span> типовую задачу
    @endslot
@endcomponent

@include('parts.flash')

<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Наименование</th>
            <th></th>
        </tr>
    </thead>

    @foreach($taskLists as $taskList)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>

            <td>
                <a title="Редактировать" href="{{ url('task-list-form/'.$taskList->id) }}">
                    {{ $taskList->name }}
                </a>
            </td>

            <td>
                <a class="table-btn-destroy" title="Удалить" href="{{ url('task-list-delete/'.$taskList->id) }}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>

@stop