<ul class="nav-list {{ session('city_id') == 2 ? 'menu-orange' : '' }}">
    <li>
        <a href="{{ url('/') }}">
            <span><i class="fas fa-home fa-fw"></i></span>
            Главная
        </a>
    </li>

    <li>
        <a href="{{ url('tasks') }}">
            <span><i class="fas fa-tasks fa-fw"></i></span>
            Задачи
        </a>
    </li>

    <li>
        <a href="{{ url('journals') }}">
            <span><i class="far fa-calendar-check fa-fw"></i></span>
            Журнал
        </a>
    </li>

    <li class="d-none d-md-block">
        <a href="{{ url('users') }}">
            <span><i class="fas fa-user-friends fa-fw"></i></span>
            Пользователи
        </a>
    </li>

    <li>
        <a href="{{ url('organizations') }}">
            <span><i class="fas fa-user-tie fa-fw"></i></span>
            Заказчики
        </a>
    </li>

    <li class="d-none d-lg-block">
        <a href="{{ url('services') }}">
            <span><i class="fas fa-certificate fa-fw"></i></span>
            Услуги
        </a>
    </li>

    <li class="d-none d-lg-block">
        <a href="{{ url('products') }}">
            <span><i class="fas fa-shopping-cart fa-fw"></i></span>
            Продукция
        </a>
    </li>


    <li class="d-none d-md-block">
        <a href="{{ url('logout') }}">
            <span><i class="fas fa-sign-out-alt fa-fw"></i></span>
            Выход
        </a>
    </li>

     <li style="padding-right: 10px;" class="d-none d-sm-block">
        <select name="city" id="city" class="form-control form-control-sm city" style="margin-top: 4px; " aria-label="Город">
            <option value="1" {{ session('city_id') == 1 ? 'selected' : '' }} >
                Кокшетау
            </option>

            <option value="2" {{ session('city_id') == 2 ? 'selected' : '' }} >
                Астана
            </option>
        </select>
    </li>
</ul>

<ul class="panel-quick">
    <li>
        <a href="{{ url('organization-form/1') }}">
            <span><i class="fas fa-plus"></i></span>
            <span class="hide-sm-text">новый </span> сотрудник

        </a>
    </li>
     <li>
        <a href="{{ url('task-form') }}">

            <span><i class="fas fa-plus"></i></span>
            <span class="hide-sm-text">новая </span> задача
        </a>
    </li>
     <li>
        <a href="{{ url('organization-form') }}">

            <span><i class="fas fa-plus"></i></span>
            <span class="hide-sm-text">новый </span> заказчик
        </a>
    </li>
</ul>

