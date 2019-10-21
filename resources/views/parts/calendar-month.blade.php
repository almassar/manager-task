@php( $month = \App\Modules\Calendar\Calendar::getMonth($month_id, $year_id) )

<table class="{{ $class.' calendar-month' }}" id="{{ $id }}">
    <thead>
        <tr>
            <th>Пн</th>
            <th>Вт</th>
            <th>Ср</th>
            <th>Чт</th>
            <th>Пт</th>
            <th>Сб</th>
            <th>Вс</th>
        </tr>
    </thead>

    <tbody>
        @foreach($month as $week)



            <tr>
                @foreach($week as $day)

                    @php($tasks = \App\Modules\Tasks\Task::getByDate($day->day, $month_id, $year_id))

                    <td class="calendar-day-click  {{ $tasks->count() > 0 ? 'calendar-task' : '' }}"
                        id="{{ 'day'.( \Illuminate\Support\Carbon::create($year_id, $month_id, $day->day)->format('d-m-Y')) }}">
                        {{ $day->day }}


                    </td>

                @endforeach
            </tr>

        @endforeach
    </tbody>

</table>



