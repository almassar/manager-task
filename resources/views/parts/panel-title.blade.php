<div class="title-panel">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between no-gutters">
            <div class="col">
                <h1> {{ $title }} </h1>
            </div>

            @isset($url)
                <div class="col-8 text-right">

                    @if(isset($titleAddBtn))
                        <a class="btn btn-primary btn-sm" href="{{ $url}}">
                            <span>
                                <i class="fa fa-plus"></i>
                            </span>
                            {{ $titleAddBtn }}
                        </a>
                    @endif
                </div>
            @endisset
        </div>
    </div>
</div>