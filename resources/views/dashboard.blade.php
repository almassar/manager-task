@extends('app')
@section('content')

@component('parts.panel-title')
    @slot('title')
        {{ $seo['title'] }}
    @endslot
@endcomponent

@include('parts.flash')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-7 col-lg-9 col-md-10 col-24">
            <ul class="list-dashboard-month">
                @foreach($periods as $period)
                    <li>
                        <a id="{{ 'link-month-id'.$period['month_id'] }}" class="{{ $period['month_id'] == date("m") ? 'month-active-link' : ''}}" href="#">{{ $period['title'] }}</a>
                    </li>
                @endforeach
            </ul>

            @foreach($periods as $period)
                <div class="dashboard-current-month">
                    @include('parts.calendar-month', [ 'class' => $period['month_id'] == date("m") ? 'calendar-active' : '',
                                                        'id' => 'calendar-month-id'.$period['month_id'],
                                                        'month_id' => $period['month_id'], 'year_id' => $period['year_id']])
                </div>
            @endforeach
        </div>

        <div class="col-xl-16 offset-xl-1 col-lg-15 col-md-14">
            <div class="not-finished-title">
                Задачи на сегодня
            </div>

            <ul class="not-finished-tasks">
                @forelse($notFinishedTasks as $task)
                    <li class="{{ ($task->date_execute == date('d.m.Y') ? 'active-task' : '').' nf-task'.date("d-m-Y", strtotime($task->date_execute) ) }}  ">
                        <a href="{{ url('task-form/'.$task->id) }}">
                            {{ $task->name }}
                        </a>

                        <div style="font-size: 13px;">
                            <b>Исполнитель:</b>
                            @foreach($task->executers as $executer)
                                {{ $executer->shortName() }}
                            @endforeach
                        </div>

                    </li>
                @empty
                    На выбранную дату задач нет!
                @endforelse
            </ul>
        </div>

    </div>
</div>

<div class="title-panel mt-3">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between no-gutters">
            <div class="col">
                <h1> Услуги заказчиков </h1>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
<table class="table table-hover table-dashboard-organization">
    <thead>
        <tr>
            <th class="tableRowNumber">#</th>
            <th>Наименование</th>
            <th>Услуга</th>
        </tr>
    </thead>

    @php($i = 1)
    @foreach($organizations as $organization)
        @if($organization->services->count() > 0)
            <tr>
                <td>
                    {{ $i++  }}
                </td>
                <td>
                    <a style="text-transform: uppercase" title="Редактировать" href="{{ url('organization-form/'.$organization->id) }}">
                        {{ $organization->name }}
                    </a>
                </td>
                <td>

                    <ul class="list-service-dashboard">
                        @foreach($organization->services as $service)
                            <li>
                                <div>
                                    {{ $service->name }}
                                </div>

                                <div>
                                    <b>Договор:</b> {{ $service->pivot->contract }}
                                    <b>Сумма: </b>  {{ $service->pivot->price }} тенге
                                </div>

                                         <ul class="list-service-dates">
                                            @foreach($organization->service_dates($service->pivot->id) as $serviceDate)
                                                <li>
                                                    {{ date('d.m.Y', strtotime($serviceDate->date)) }}
                                                </li>
                                            @endforeach
                                        </ul>
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endif
    @endforeach
</table>
</div>

@stop

