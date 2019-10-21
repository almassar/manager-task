@extends('app')
@section('content')

<div class="login-page">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-xl-8 col-lg-10 col-md-14 col-sm-18 col-22">

                <form action="{{ route('login') }}" method="POST">
                    {!! csrf_field() !!}

                    <h3>Менеджер задач</h3>

                    @if($errors->count() > 0)
                        <div class="alert alert-danger">
                            Вы вели не верный пароль!
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-envelope"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" autofocus placeholder="Email" name="email" aria-label="Email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                            <input type="password" class="form-control" placeholder="Пароль" name="password" aria-label="Пароль">
                        </div>
                    </div>

                    <div class="form-group remember">
                        <input type="checkbox" name="remember" id="remember" checked>
                        <label for="remember">
                            Оставаться в системе
                        </label>
                    </div>

                    <button class="btn btn-success">Войти</button>
                </form>

            </div>
        </div>
    </div>
</div>
@stop

