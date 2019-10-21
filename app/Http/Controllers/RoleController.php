<?php

namespace App\Http\Controllers;

use App\Modules\Flash\Facades\Flash;
use App\Modules\Roles\{Role, RoleRepository};
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function all()
    {
        $seo['title'] = 'Должности';

        $roles = $this->roleRepository->all();

        return view('roles.all')->with(['seo' => $seo, 'roles' => $roles]);
    }

    public function form(Role $role = null)
    {
        $seo['title'] = ($role === null ?  'Добавление' : 'Редактирование').' должности';

        $roles = $this->roleRepository->all();

        return view('roles.save')->with(['role' => $role, 'roles' => $roles, 'seo' => $seo]);
    }

    public function save(Request $request, Role $role = null)
    {
        $this->roleRepository->save($request->all(), $role);

        Flash::success('Должность успешно сохранен!');
        return redirect('roles');
    }

    public function delete(Role $role)
    {
        $this->roleRepository->delete($role->id);

        Flash::success('Должность успешно удален!');
        return redirect('roles');
    }
}
