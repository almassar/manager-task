@extends('app')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-24">

            @component('parts.panel-title', ['url' => url('/') ])
                @slot('title')
                    {{ $seo['title'] }}
                @endslot

            @endcomponent

            @include('parts.flash')

            <div class="panel-sub">
                <div class="row justify-content-between">
                <form action="{{ url('journal-save') }}" method="POST" class="col-12">
                    {!! csrf_field() !!}

                    <div class="form-row">
                        <div class="col-xl-7 col-8">
                            <select name="user_id" class="form-control form-control-sm"  aria-label="Сотрудник">
                                <option>Выберите сотрудника </option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-4">
                            <input type="text" class="form-control datepicker form-control-sm" autocomplete="off" name="date" required value="{{ date('d.m.Y') }}" aria-label="Дата">
                        </div>

                        <div class="col-xl-6 col-8">
                            <input type="text" class="form-control form-control-sm" required placeholder="Место локации" name="locate" aria-label="Локация">
                        </div>

                        <div class="col-5">
                            <button class="btn btn-primary btn-sm">
                                <span><i class="fas fa-plus"></i></span>
                                Добавить
                            </button>
                        </div>
                    </div>
                </form>


                <form action="{{ url('journal-search') }}" method="POST" class="col-6">
                    {!! csrf_field() !!}

                    <div class="form-row">
                        <div class="col-xl-18 col-18">
                            <input type="text" class="form-control form-control-sm" required placeholder="Поиск локации..." name="locate" aria-label="Локация">
                        </div>

                        <div class="col-6">
                            <button class="btn btn-danger btn-sm">
                                <span><i class="fas fa-search"></i></span>
                                Поиск
                            </button>
                        </div>
                    </div>
                </form>
                </div>

            </div>

            <ul class="journals-search">
            @foreach($journals as $journal)
                <li>
                    @php
                        $dates = collect(explode(',' ,$journal->dates))->sort();

                        $groupDates = $dates->groupBy(function ($item, $key) {
                            return substr($item, 0, 7);
                        });
                    @endphp

                    <div>
                        <a href="{{ url('user-form/'.$journal->user_id) }}" >
                            {{ \App\Modules\Users\User::find($journal->user_id)->name.' - '.count($dates) }}
                        </a>
                    </div>

                    @foreach($groupDates as $key => $dates)

                        <div style="margin-bottom: 10px;">
                            <b style="display: block; color:#383838">
                                {{ \App\Modules\Calendar\Calendar::getTitleMonth(intval(substr( $key, -2))) }}
                            </b>
                            @foreach($dates as $date)
                                <span>
                                    {{ date("d.m.Y", strtotime($date)) }}
                                </span>
                            @endforeach
                        </div>
                    @endforeach

                </li>
            @endforeach
            </ul>
        </div>
    </div>
</div>
@stop