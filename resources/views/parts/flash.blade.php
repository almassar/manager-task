<div class="container-fluid">
    @if (Session::has('flash.message'))
        <div class="alert alert-{{ Session::get('flash.level') }}">
            @if (Session::get('flash.level') == 'success')
                <span><i class="fas fa-check"></i></span>
            @endif

            {{ Session::get('flash.message') }}
        </div>
    @endif
</div>



