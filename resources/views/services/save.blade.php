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
        <div class="col-xl-10 col-lg-14 col-md-12">
            <form class="form-well" action="{{ url('service-group-save/'.optional($serviceGroup)->id) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Наименование группы</label>
                    <input type="text" class="form-control form-control-sm" name="name" value="{{ optional($serviceGroup)->name }}" required id="name">
                </div>

                <button class="btn btn-success btn-sm"><span><i class="fas fa-check"></i></span> Сохранить</button>

            </form>
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">

        <div class="col-xl-24">

            <h5 class="title-page">Услуги</h5>

            <div class="panel-sub">

            <form action="{{ url('service-save') }}" method="post" class="col-10">
                {!! csrf_field() !!}
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Наименование услуги" name="name" aria-label="Наименование">

                    <input type="hidden" name="service_group_id" value="{{ $serviceGroup->id }}">

                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <span><i class="fas fa-plus"></i></span>
                            Добавить
                        </button>
                    </div>
                </div>
            </form>

            </div>

            <ol class="list-form-service">
                @foreach($serviceGroup->services as $service)
                    <li>
                        {{ $service->name }}
                    </li>
                @endforeach
            </ol>

        </div>
    </div>
</div>
@stop
