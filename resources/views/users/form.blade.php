<form class="form-well" action="{{ url('user-save/'.optional($user)->id) }}" method="post">
    {!! csrf_field() !!}

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="name">Ф.И.О. сотрудника</label>
                <input type="text" class="form-control form-control-sm" name="name" value="{{ optional($user)->name }}" required id="name">

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" value="1" name="is_client" {{ optional($user)->is_client == 1 ? 'checked' :'' }} id="is_client">
                    <label for="is_client" class="form-check-label" >Клиент</label>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="role">Должность</label>

                <select name="role_id" id="role" required class="form-control form-control-sm">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ optional($user)->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="mobile-phone">Мобильный</label>
                <input type="tel" class="form-control form-control-sm" name="mobile_phone" value="{{ optional($user)->mobile_phone }}" required id="mobile-phone">
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-sm" name="email" value="{{ optional($user)->email }}" id="email">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="organization">Организация</label>
                <select name="organization_id" id="organization" required class="form-control form-control-sm">
                    @foreach($organizations as $organization)
                        <option value="{{ $organization->id }}" {{ optional($user)->organization_id == $organization->id ? 'selected' : '' }}>
                            {{ $organization->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <button class="btn btn-success btn-sm"><span><i class="fas fa-check"></i></span> Сохранить</button>

</form>
