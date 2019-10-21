<?php

namespace App\Http\Controllers;

use App\Modules\Flash\Facades\Flash;
use App\Modules\ServiceGroups\ServiceGroup;
use App\Modules\ServiceGroups\ServiceGroupRepository;
use App\Modules\Services\Service;
use App\Modules\Services\ServiceRepository;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $serviceGroupRepository;
    private $serviceRepository;

    public function __construct(ServiceGroupRepository $serviceGroupRepository, ServiceRepository $serviceRepository)
    {
        $this->serviceGroupRepository = $serviceGroupRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function all()
    {
        $seo['title'] = 'Услуги';

        $serviceGroups = $this->serviceGroupRepository->all();

        return view('services.all')->with(['seo' => $seo, 'serviceGroups' => $serviceGroups]);
    }

    public function formGroup(ServiceGroup $serviceGroup = null)
    {
        $seo['title'] = ($serviceGroup === null ?  'Добавление' : 'Редактирование').' группы';

        return view('services.save')->with(['serviceGroup' => $serviceGroup, 'seo' => $seo]);
    }

    public function save(Request $request, Service $service = null)
    {
        $this->serviceRepository->save($request->all(), $service);

        Flash::success('Услуга успешно сохранена!');

        return redirect('service-group-form/'.$request->input('service_group_id'));
    }

    public function delete(Role $service)
    {
        $this->serviceRepository->delete($service->id);

        Flash::success('Должность успешно удален!');
        return redirect('services');
    }

    public function saveGroup(Request $request, ServiceGroup $serviceGroup = null)
    {
        $id = $this->serviceGroupRepository->save($request->all(), $serviceGroup)->id;

        Flash::success('Группа сохранена!');

        if ($serviceGroup == null)
            return redirect('service-group-form/'.$id);

        return redirect('services');
    }
}
