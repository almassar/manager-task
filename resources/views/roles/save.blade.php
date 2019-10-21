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
            <form class="form-well" action="{{ url('role-save/'.optional($role)->id) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Должность</label>
                    <input type="text" class="form-control" name="name" value="{{ optional($role)->name }}" required id="name">
                </div>

                <button class="btn btn-success"><span><i class="fas fa-check"></i></span> Сохранить</button>

            </form>
        </div>
    </div>
</div>
@stop
