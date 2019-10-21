@extends('app')
@section('content')

<div class="container-fluid">
    @component('parts.panel-title')
        @slot('title')
            {{  $seo['title'] }}
        @endslot
    @endcomponent

    @include('parts.flash')

    <div class="row">
        <div class="col-xl-10 col-lg-14 col-md-24">
            <form class="form-well" action="{{ url('journal-save/'.optional($journal)->id) }}" method="post">
                {!! csrf_field() !!}

                <div style="margin-bottom: 10px; font-weight: bold">
                    {{ $journal->user->name }}
                </div>

                <div class="row">
                    <div class="form-group col-18">
                        <label for="locate">Локация</label>
                        <input type="text" class="form-control form-control-sm" name="locate" value="{{ optional($journal)->locate }}" required id="locate">
                    </div>

                    <div class="col-6">
                        <label for="date">Дата</label>
                        <input type="text" disabled class="form-control datepicker form-control-sm" autocomplete="off" name="date" required value="{{ optional($journal)->date }}" aria-label="Дата">
                    </div>
                </div>

                <button class="btn btn-success btn-sm"><span><i class="fas fa-check"></i></span> Сохранить</button>

            </form>
        </div>
    </div>
</div>
@stop
