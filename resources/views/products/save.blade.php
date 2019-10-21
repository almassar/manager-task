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
            <form class="form-well" action="{{ url('product-group-save/'.optional($productGroup)->id) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Наименование группы</label>
                    <input type="text" class="form-control" name="name" value="{{ optional($productGroup)->name }}" required id="name">
                </div>

                <button class="btn btn-success"><span><i class="fas fa-check"></i></span> Сохранить</button>

            </form>
        </div>


        <div class="xl-10">

            <h5>Продукция</h5>

            <form action="{{ url('product-save') }}" method="post">
                {!! csrf_field() !!}
                <div class="input-group input-group-sm">
                    <input type="text" value="{{ $nameSearch ?? '' }}" class="form-control" placeholder="Наименование продукции" name="name" aria-label="Наименование">

                    <input type="hidden" name="product_group_id" value="{{ $productGroup->id }}">

                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <span><i class="fas fa-plus"></i></span>
                            Добавить
                        </button>
                    </div>
                </div>
            </form>

            <ol class="list-form-product">
                @foreach($productGroup->products as $product)
                    <li>
                        {{ $product->name }}
                    </li>
                @endforeach
            </ol>

        </div>

    </div>
</div>
@stop
