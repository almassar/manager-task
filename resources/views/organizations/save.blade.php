@extends('app')
@section('content')

<div class="container-fluid">
    @component('parts.panel-title')
        @slot('title')
            {{  $seo['title'] }}
        @endslot
    @endcomponent

    @include('parts.flash')

    <div class="row justify-content-between">
        <div class="col-xl-8 col-lg-12 col-md-12 col-24">
            <form class="form-well" action="{{ url('organization-save/'.optional($organization)->id) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Название организации</label>
                    <input type="text" class="form-control form-control-sm" name="name" value="{{ optional($organization)->name }}" required id="name">
                </div>

                <div class="form-group">
                    <label for="address">Адрес</label>
                    <input type="text" class="form-control form-control-sm" name="address" value="{{ optional($organization)->address }}" required id="address">
                </div>

                <button class="btn btn-success btn-sm"><span><i class="fas fa-check"></i></span> Сохранить</button>
            </form>
        </div>

        @if($organization !== null)
            <div class="col-xl-8 col-lg-12 col-md-12 col-24">

                <ul class="list-border">
                    @foreach($organization->users as $user)
                        <li>
                            <div>
                                {{ $user->name }} - {{ $user->role->name }}
                            </div>

                            <div>
                                {{ $user->mobile_phone }}
                            </div>
                        </li>
                    @endforeach
                </ul>

                <form class="form-sub-well" action="{{ url('organization-user-save') }}" method="post">
                    {!! csrf_field() !!}

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">

                                <input type="text" class="form-control form-control-sm" name="name" required id="name" placeholder="Ф.И.О. сотрудника">

                                <div class="form-check">
                                    <input type="hidden" class="form-check-input" value="1" name="is_client" id="is_client">

                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <select name="role_id" id="role" required class="form-control form-control-sm" aria-label="Должность">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="tel" class="form-control form-control-sm" name="mobile_phone" placeholder="Мобильный" id="mobile-phone" aria-label="Мобильный">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-sm" name="email" placeholder="Email" id="email" aria-label="Email">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" value="{{ $organization->id }}" name="organization_id">

                    <button class="btn btn-primary btn-sm"><span><i class="fas fa-plus"></i></span> Добавить</button>
                </form>
            </div>
        @endif
    </div>

    @if($organization !== null)
        <div class="row" style="margin-top: 0; padding-top: 20px ">

            <div class="col-24">
                <h5 class="title-page">Услуги</h5>

                <div class="panel-sub" style="padding-left: 7px;">

                    <form action="{{ url('organization-service-save/'.$organization->id) }}" method="post">
                        {!! csrf_field() !!}

                        <div class="form-row">
                            <div class="col-8">
                                <select name="service_id" id="service_id" class="form-control form-control-sm" required aria-label="Выберите услугу">
                                    <option disabled selected>Выберите услугу</option>
                                    @foreach($serviceGroups as $serviceGroup)
                                        <optgroup label="{{ $serviceGroup->name }}">
                                            @foreach($serviceGroup->services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-3">
                                <input type="text" placeholder="№ договора" name="contract" class="form-control form-control-sm" aria-label="№ договора">
                            </div>

                            <div class="col-xl-2 col-md-4 col-2">
                                <input type="number" placeholder="Цена" name="price" class="form-control form-control-sm" aria-label="Цена">
                            </div>
                            <div class="col-md-5 col-3">
                                <button class="btn btn-primary btn-sm"><span><i class="fas fa-plus"></i></span> Добавить</button>
                            </div>
                        </div>
                    </form>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="tableRowNumber">#</th>
                            <th>Наименование</th>
                            <th>№договора</th>
                            <th>Сумма</th>
                            <th>Дата исполнения</th>
                            <th></th>
                            <th class="tableOperation"></th>
                        </tr>
                    </thead>

                    @foreach($organization->services as $service)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                 {{ $service->name }}
                            </td>
                            <td>
                                {{ $service->pivot->contract }}
                            </td>
                            <td>
                                {{ $service->pivot->price }} тенге
                            </td>
                            <td>
                                <ul class="list-service-dates">
                                    @foreach($organization->service_dates($service->pivot->id) as $serviceDate)
                                        <li>
                                            {{ date('d.m.Y', strtotime($serviceDate->date)) }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>

                            <td>
                                <form action="{{ url('service-date-save/'.$organization->id) }}" method="post">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="organization_service_id" value="{{ $service->pivot->id }}">
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" style="font-size: 13px;" class="form-control form-control-sm datepicker" name="date" value="{{ date('d.m.Y') }}" required id="date" aria-label="Дата">
                                        <div class="input-group-append">
                                            <button class="btn btn-info btn-sm" style="font-size: 13px;">+</button>
                                        </div>
                                    </div>
                                </form>
                            </td>

                            <td>
                                <a class="table-btn-destroy" title="Удалить" href="{{ url('organization-service-delete/'.$organization->id.'/'.$service->id) }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                 </table>

            </div>

        </div>

        <div class="row">
            <div class="col-24">
                <h5 class="title-page">
                    Заметки
                </h5>

                <form action="{{ url('organization-note-save/'.$organization->id) }}" method="post">
                    @csrf

                    <div class="form-row">
                        <div class="col-18">
                            <input type="text" placeholder="Введите заметку..." name="content" class="form-control form-control-sm" aria-label="Введите заметку...">
                        </div>

                        <div class="col-3">
                            <button class="btn btn-primary btn-sm"><span><i class="fas fa-plus"></i></span> Добавить</button>
                        </div>
                    </div>
                </form>

                <ul class="organization-notes">
                    @foreach($organization->notes as $note)
                        <li>
                            <div style="font-size: 11px;">
                                {{ date('d.m.Y', strtotime($note->created_at))}}
                            </div>
                            {{ $note->content }}
                            <a class="table-btn-destroy float-right" title="Удалить заметку" href="{{ url('organization-note-delete/'.$organization->id.'/'.$note->id) }}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    @endif

</div>
@stop
