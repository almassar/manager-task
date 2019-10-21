@extends('app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-24">

            @component('parts.panel-title', ['url' => url('user-form') ])
                @slot('title')
                    {{ $seo['title'] }} - {{ $isSearch ? '' : $users->total()  }}
                @endslot

                @slot('titleAddBtn')
                    Добавить пользователя
                @endslot
            @endcomponent

            @include('parts.flash')

            <div class="panel-sub">

                <form action="{{ url('search-users') }}" method="POST" class="col-8 offset-16">
                    {!! csrf_field() !!}
                    <div class="input-group input-group-sm">
                        <input type="text" value="{{ $nameSearch ?? '' }}" class="form-control" placeholder="Поиск пользователя..." name="name" aria-label="Имя">
                        <div class="input-group-append">
                            <button class="btn btn-success">
                                <span><i class="fas fa-search"></i></span>
                                Найти
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="tableRowNumber">#</th>
                        <th>Ф.И.О. пользователя</th>
                        <th>Должность</th>
                        <th>Мобильный</th>
                        <th>Email</th>
                        <th>Организация</th>
                        <th class="tableOperation"></th>
                    </tr>
                </thead>

                @foreach($users as $user)
                    <tr>
                        <td>
                            @if(!$isSearch)
                                {{ $loop->iteration + $users->perPage() * ($users->currentPage() - 1) }}
                            @endif
                        </td>

                        <td>
                            <a style="{{ $user->is_client == 1 ? 'color:green' : '' }}" class="table-btn-edit"  title="Редактировать" href="{{ url('user-form/'.$user->id) }}">
                                {{ $user->name }}
                            </a>
                        </td>

                        <td>
                            {{ $user->role->name }}
                        </td>

                        <td>
                            {{ $user->mobile_phone }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>
                            {{ optional($user->organization)->name }}
                        </td>

                        <td>
                            <a class="table-btn-destroy" title="Удалить" href="{{ url('user-delete/'.$user->id) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

                @if(!$isSearch)
                    {{ $users->links() }}
                @endif

        </div>
    </div>
</div>
@stop