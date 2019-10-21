@extends('app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-24">

            @component('parts.panel-title', ['url' => url('role-form') ])
                @slot('title')
                    {{ $seo['title'] }} - {{ $roles->count() }}
                @endslot

                @slot('titleAddBtn')
                    Добавить должность
                @endslot
            @endcomponent

            @include('parts.flash')

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="tableRowNumber">#</th>
                        <th>Наименование</th>
                        <th class="tableOperation"></th>
                    </tr>
                </thead>

                @foreach($roles as $role)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <a title="Редактировать" href="{{ url('role-form/'.$role->id) }}">
                                {{ $role->name }}
                            </a>
                        </td>

                        <td>
                            <a class="table-btn-destroy" title="Удалить" href="{{ url('role-delete/'.$role->id) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@stop