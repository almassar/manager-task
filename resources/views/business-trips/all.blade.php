<div class="title-panel mt-4">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between no-gutters">
            <div class="col">
                <h1> Командировки - {{ $businessTrips->total() }} </h1>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="panel-sub">
        <div class="row justify-content-between">
            <form action="{{ url('business-trip-save') }}" method="POST" class="col-xl-24 col-lg-24 col-md-16 col-sm-24 col-24" style="margin-top: 0">
                {!! csrf_field() !!}

                <div class="form-row">
                    <div class="col-xl-5 col-lg-5 col-md-8 col-9">
                        <select name="user_id" class="form-control form-control-sm" required aria-label="Сотрудник">
                            <option value="">Выберите сотрудника </option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-5 col-5">
                        <input type="text" class="form-control datepicker form-control-sm" autocomplete="off" name="date_begin" required value="{{ date('d.m.Y') }}" aria-label="Дата начало">
                    </div>

                     <div class="col-xl-2 col-lg-3 col-md-5 col-5">
                        <input type="text" class="form-control datepicker form-control-sm" autocomplete="off" name="date_end" required value="{{ date('d.m.Y') }}" aria-label="Дата конец">
                    </div>

                    <div class="col-xl-5 col-lg-5 col-8">
                        <input type="text" class="form-control form-control-sm" required placeholder="Место локации" name="locate" aria-label="Локация">
                    </div>

                     <div class="col-xl-5 col-lg-5 col-8">
                        <input type="text" class="form-control form-control-sm" required placeholder="Объект" name="object" aria-label="Объект">
                    </div>

                    <div class="col-xl-4 col-lg-2 col-md-3 col-1">
                        <button class="btn btn-primary btn-sm">
                            <span><i class="fas fa-plus"></i></span>
                            <span class="d-none d-xl-inline">Добавить</span>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <table class="table table-hover">
        <thead>
            <tr>
                <th class="tableRowNumber">#</th>
                <th>Сотрудник</th>
                <th>Период</th>
                <th>Локация</th>
                <th>Объект</th>
                <th class="tableOperation"></th>
            </tr>
        </thead>

        @foreach($businessTrips as $businessTrip)
            <tr>
                <td>
                    {{ $loop->iteration + $businessTrips->perPage() * ($businessTrips->currentPage() - 1) }}
                </td>

                <td>
                    <a title="Редактировать" href="{{ url('') }}">
                        {{ $businessTrip->user->shortName() }}
                    </a>
                </td>

                <td>
                    {{ $businessTrip->date_begin.' - '.$businessTrip->date_end }}
                </td>

                <td>
                    {{ $businessTrip->locate }}
                </td>

                <td>
                    {{ $businessTrip->object }}
                </td>

                <td>
                    <a class="table-btn-destroy" title="Удалить" href="{{ url('') }}">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $businessTrips->links() }}


</div>