@extends('app')
@section('content')

@component('parts.panel-title', ['url' => url('organization-form') ])
    @slot('title')
        {{ $seo['title'] }} - {{ $isSearch ? '' : $organizations->total()  }}
    @endslot

    @slot('titleAddBtn')
        <span class="d-none d-sm-inline">Добавить</span> заказчика
    @endslot
@endcomponent

@include('parts.flash')

<div class="panel-sub">

    <div class="row">
    <form action="{{ url('organization-search') }}" method="post" class="col-20 col-md-10">
        {!! csrf_field() !!}
        <div class="input-group input-group-sm">
            <input type="text" value="{{ $nameSearch ?? '' }}" class="form-control" placeholder="Поиск организации..." name="name" aria-label="Поиск организации">
            <div class="input-group-append">
                <button class="btn btn-success">
                    <span><i class="fas fa-search"></i></span>
                    Найти
                </button>
            </div>
        </div>
    </form>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Наименование</th>
            <th class="d-none d-md-table-cell">Услуги</th>
            <th>Адрес</th>
            <th class="d-none d-md-table-cell">Контактное лицо</th>
            <th class="d-none d-md-table-cell"></th>
        </tr>
    </thead>

    @foreach($organizations as $organization)
        <tr>
            <td>
                @if(!$isSearch)
                    {{ $loop->iteration + $organizations->perPage() * ($organizations->currentPage() - 1) }}
                @endif
            </td>

            <td>
                <a class="table-btn-edit"  title="Редактировать" href="{{ url('organization-form/'.$organization->id) }}">
                    {{ $organization->name }}
                </a>
            </td>

            <td style="font-weight: 600" class="d-none d-md-table-cell">
                {{ $organization->services->count() == 0 ? '': $organization->services->count().' штук' }}
            </td>

            <td>
                {{ $organization->address }}
            </td>

            <td class="d-none d-md-table-cell">
                <ul class="list-contact">

                    @foreach($organization->users as $user)
                        <li>
                            <div>
                                {{ $user->name }}
                            </div>

                            <div>
                                {{ $user->mobile_phone }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </td>

            <td class="d-none d-md-table-cell">
                <a class="table-btn-destroy" title="Удалить" href="{{ url('organization-delete/'.$organization->id) }}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
    @endforeach
</table>

@if(!$isSearch)
    {{ $organizations->links() }}
@endif


@stop