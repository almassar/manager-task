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

            @include('users.form')

        </div>

        <div class="col-12">
            <h5 class="title-page">Журнал посещений</h5>
            <ul class="list-user-journals">
                @foreach($journals as $journal)
                    <li>
                        {{ $journal->date.' - '.$journal->locate }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    задачи

    услуги

</div>
@stop
