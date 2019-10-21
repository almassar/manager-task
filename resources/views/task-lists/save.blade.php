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
            <form class="form-well" action="{{ url('task-list-save/'.optional($taskList)->id) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Типовая задача</label>
                    <input type="text" class="form-control form-control-sm" name="name" value="{{ optional($taskList)->name }}" required id="name">
                </div>

                <button class="btn btn-success btn-sm"><span><i class="fas fa-check"></i></span> Сохранить</button>

            </form>
        </div>
    </div>
</div>
@stop
