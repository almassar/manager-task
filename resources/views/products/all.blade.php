@extends('app')
@section('content')

@component('parts.panel-title', ['url' => url('') ])
    @slot('title')
        {{ $seo['title'] }}
    @endslot
@endcomponent

@include('parts.flash')

<div class="container-fluid">
    <div class="panel-sub">
        <div class="row">
            <form action="{{ url('product-group-save') }}" method="POST" class="col-xl-14 col-lg-16 col-md-20 col-24-sm col-24">
                {!! csrf_field() !!}

                <div class="form-row">
                    <div class="col-sm-16 col-16">
                        <input type="text" class="form-control form-control-sm" required placeholder="Наименование группы" name="name" aria-label="Локация">
                    </div>

                    <div class="col-sm-8 col-8">
                        <button class="btn btn-primary btn-sm">
                            <span><i class="fas fa-plus"></i></span>
                            Добавить группу
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
                <th>Наименование</th>
                <th class="tableOperation"></th>
            </tr>
        </thead>

        @foreach($productGroups as $productGroup)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    <a title="Редактировать" href="{{ url('product-group-form/'.$productGroup->id) }}">
                        {{ $productGroup->name }}
                    </a>
                </td>

                <td>
                    <ol>
                        @foreach($productGroup->products as $product)
                            <li>
                                <a href="{{ url('') }}">
                                    {{ $product->name }}
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </td>

                <td>
                    <a class="table-btn-destroy" title="Удалить" href="{{ url('') }}">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@stop