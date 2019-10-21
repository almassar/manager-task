@extends('app')
@section('content')

@component('parts.panel-title', ['url' => url('/') ])
    @slot('title')
        {{ $seo['title'] }}
    @endslot

@endcomponent

@include('parts.flash')

<div class="container-fluid">
    <div class="panel-sub">
        <div class="row justify-content-between">
            <form action="{{ url('journal-save') }}" method="POST" class="col-xl-18 col-lg-15 col-md-16 col-sm-24 col-24" style="margin-top: 0">
                {!! csrf_field() !!}

                <div class="form-row">
                    <div class="col-xl-5 col-md-8 col-9">
                        <select name="user_id" class="form-control form-control-sm" required aria-label="Сотрудник">
                            <option value="">Выберите сотрудника </option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-2 col-lg-4 col-md-5 col-5">
                        <input type="text" class="form-control datepicker form-control-sm" autocomplete="off" name="date" required value="{{ date('d.m.Y') }}" aria-label="Дата">
                    </div>

                    <div class="col-xl-5 col-8">
                        <input type="text" class="form-control form-control-sm" required placeholder="Место локации" name="locate" aria-label="Локация">
                    </div>

                    <div class="col-xl-4 col-md-3 col-1">
                        <button class="btn btn-primary btn-sm">
                            <span><i class="fas fa-plus"></i></span>
                            <span class="d-none d-xl-inline">Добавить</span>
                        </button>
                    </div>
                </div>
            </form>

            <form action="{{ url('journal-search') }}" method="POST" class="col-xl-6 col-lg-9 col-md-8 col-sm-24 col-24 float-right" >
                {!! csrf_field() !!}

                <div class="form-row justify-content-between">
                    <div class="col-xl-17 col-lg-21 col-md-20 col-22" >
                        <input type="text" class="form-control form-control-sm" required placeholder="Поиск локации..." name="locate" aria-label="Локация">
                    </div>

                    <div class="col-xl-7 col-lg-3 col-md-4 col-2">
                        <button class="btn btn-danger btn-sm">
                            <span><i class="fas fa-search"></i></span>
                            <span class="d-none d-xl-inline">Поиск</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="panel-month">
        @foreach($monthsYears as $monthYear)
            <a href="{{ url('journals/'.$monthYear->month_id.'/'.$monthYear->year_id) }}">
                {{ \App\Modules\Calendar\Calendar::getTitleMonth( $monthYear->month_id ) }}
            </a>
        @endforeach
    </div>

    <div class="table-flexbox">
        <div class="row-head">
            <div class="th-ex th-first">
                Сотрудник
            </div>

            @foreach($daysMonths as $day)
                <div class="th-ex">
                    {{ date('d/m', strtotime($day->date)) }}
                </div>
            @endforeach

        </div>


        @foreach($lastUsers as $lastUser)
            <div class="row-content">
                <div class="td-ex td-first">
                    <a title="{{ $lastUser->user->name }}" href="{{ url('user-form/'.$lastUser->user->id) }}">
                        {{ $lastUser->user->shortName() }}
                    </a>
                </div>

                @foreach($daysMonths as $day)
                    <div class="td-ex">
                        <a style="color: #636b6f" title="{{ optional($lastUser->getLocate($day->date))->locate }}" href="{{ url('journal-form/'.$lastUser->user_id.'/'.$day->date) }}">
                            {{ mb_substr(optional($lastUser->getLocate($day->date))->locate, 0, 6) }}
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

@include('business-trips.all')

@stop