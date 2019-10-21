<footer class="d-block d-sm-none">
    <ul>
        <li>
            <select name="city" id="city" class="form-control form-control-sm city" aria-label="Город">
                <option value="1" {{ session('city_id') == 1 ? 'selected' : '' }} >
                    Кокшетау
                </option>

                <option value="2" {{ session('city_id') == 2 ? 'selected' : '' }} >
                    Астана
                </option>
            </select>
        </li>

        <li>
            <a href="{{ url('logout') }}">Выход</a>
        </li>
    </ul>

</footer>
