<?php

namespace App\Http\Controllers;

use App\Modules\Flash\Facades\Flash;
use App\Modules\Journals\JournalRepository;
use App\Modules\Organizations\OrganizationRepository;
use App\Modules\Roles\RoleRepository;
use App\Modules\Users\{UserRepository, User};
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;
    private $roleRepository;
    private $organizationRepository;
    private $journalRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository,
                                OrganizationRepository $organizationRepository, JournalRepository $journalRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->organizationRepository = $organizationRepository;
        $this->journalRepository = $journalRepository;
    }

    public function all()
    {
        $seo['title'] = 'Пользователи';

        $users = $this->userRepository->orderBy('is_client', 'desc')->orderBy('name', 'asc')->paginate();

        return view('users.all')->with(['seo' => $seo, 'users' => $users, 'isSearch' => false]);
    }

    public function form(User $user = null)
    {
        $seo['title'] = ($user === null ?  'Добавление' : 'Редактирование').' пользователя';

        $roles = $this->roleRepository->all();
        $organizations = $this->organizationRepository->orderBy('name')->all();

        $journals = null;
        if ($user !== null)
            $journals = $this->journalRepository->where(['user_id' => $user->id])->get();


        return view('users.save')->with(['user' => $user, 'roles' => $roles, 'organizations' => $organizations, 'journals' => $journals, 'seo' => $seo]);
    }

    public function save(Request $request, User $user = null)
    {
        $this->userRepository->save($request->all(), $user);

        Flash::success('Сотрудник успешно сохранен!');
        return redirect('users');
    }

    public function delete(User $user)
    {
        $this->userRepository->delete($user->id);

        Flash::success('Сотрудник успешно удален!');
        return redirect('users');
    }

    public function search(Request $request)
    {
        if($request->input('name') == '')
            return redirect('organizations');


        $seo['title'] = 'Поиск пользователя';

        $organizations = $this->userRepository->search($request->input('name'));

        return view('users.all')->with(['seo' => $seo, 'users' => $organizations,
            'isSearch' => true, 'nameSearch' => $request->input('name')]);
    }
}
