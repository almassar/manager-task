<?php

namespace App\Http\Controllers;

use App\Modules\Flash\Facades\Flash;
use App\Modules\Notes\Note;
use App\Modules\Notes\NoteRepository;
use App\Modules\Organizations\{OrganizationRepository, Organization};
use App\Modules\Roles\RoleRepository;
use App\Modules\ServiceGroups\ServiceGroupRepository;
use App\Modules\Services\Service;
use App\Modules\Users\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    private $organizationRepository;
    private $roleRepository;
    private $userRepository;
    private $serviceGroupRepository;
    private $noteRepository;

    public function __construct(OrganizationRepository $organizationRepository, RoleRepository $roleRepository,
                                UserRepository $userRepository, ServiceGroupRepository $serviceGroupRepository,
                                NoteRepository $noteRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->noteRepository = $noteRepository;
        $this->organizationRepository = $organizationRepository;
        $this->serviceGroupRepository = $serviceGroupRepository;
    }

    public function all()
    {
        $seo['title'] = 'Заказчики';

        $organizations = $this->organizationRepository->paginate(20);

        return view('organizations.all')->with(['seo' => $seo, 'organizations' => $organizations, 'isSearch' => false]);
    }

    public function form(Organization $organization = null)
    {
        $seo['title'] = ($organization === null ?  'Добавление' : 'Редактирование').' заказчика';

        $roles = $this->roleRepository->orderBy('name')->all();
        $serviceGroups = $this->serviceGroupRepository->all();

        return view('organizations.save')->with(['organization' => $organization, 'serviceGroups' => $serviceGroups,
                                                 'roles'  => $roles, 'showSidebar' => false, 'seo' => $seo]);
    }

    public function save(Request $request, Organization $organization = null)
    {
        $id = $this->organizationRepository->save($request->all(), $organization)->id;

        Flash::success('Заказчик успешно сохранен!');

        if ($organization == null)
            return redirect('organization-form/'.$id);

        return redirect('organizations');
    }

    public function saveUser(Request $request)
    {
        $this->userRepository->save($request->all());

        Flash::success('Сотрудник успешно добавлен!');
        return redirect('organization-form/'.$request->input('organization_id'));
    }

    public function saveService(Request $request, Organization $organization)
    {
        $organization->services()->attach([$request->input('service_id') =>
                                            ['contract' => $request->input('contract'), 'price' => $request->input('price')]
                                          ]);

        Flash::success('Услуга успешно сохранена!');
        return redirect('organization-form/'.$organization->id);
    }

    public function saveServiceDate(Request $request, Organization $organization)
    {
        DB::table('service_date')->insert(['date' => date('Y-m-d', strtotime($request->input('date'))),
                                           'organization_service_id' => $request->input('organization_service_id')]);

        Flash::success('Дата успешно сохранена!');
        return redirect('organization-form/'.$organization->id);
    }

    public function saveNotes(Organization $organization)
    {
        $this->noteRepository->save(['content' => request('content'), 'organization_id' => $organization->id]);

        Flash::success('Заметка успешно сохранена!');
        return redirect('organization-form/'.$organization->id);
    }

    public function delete(Organization $organization)
    {
        $this->organizationRepository->delete($organization->id);

        Flash::success('Заказчик успешно удален!');
        return redirect('organizations');
    }


    public function deleteService(Organization $organization, Service $service)
    {
        $organization->services()->detach($service->id);

        Flash::success('Услуга успешно удалена!');
        return redirect('organization-form/'.$organization->id);
    }

    public function deleteNote(Organization $organization, Note $note)
    {
        $this->noteRepository->delete($note->id);

        Flash::success('Заметка успешно удалена!');
        return redirect('organization-form/'.$organization->id);
    }

    public function search(Request $request)
    {
        if($request->input('name') == '')
            return redirect('organizations');


        $seo['title'] = 'Поиск заказчиков';

        $organizations = $this->organizationRepository->search($request->input('name'));

        return view('organizations.all')->with(['seo' => $seo, 'organizations' => $organizations,
                                                'isSearch' => true, 'nameSearch' => $request->input('name')]);
    }
}
