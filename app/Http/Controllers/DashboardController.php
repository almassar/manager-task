<?php

namespace App\Http\Controllers;

use App\Modules\Calendar\Calendar;
use App\Modules\Organizations\OrganizationRepository;
use App\Modules\Tasks\TaskRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $organizationRepository;
    private $taskRepository;

    public function __construct(OrganizationRepository $organizationRepository, TaskRepository $taskRepository)
    {
        $this->organizationRepository = $organizationRepository;
        $this->taskRepository = $taskRepository;
    }

    public function index()
    {
        $seo['title'] = $this->getNowDateTitle();

        $periods = Calendar::getPeriods();

        $organizations = $this->organizationRepository->all();

        $notFinishedTasks = $this->taskRepository->where(['is_finish' => 0])->orderBy('date_execute')->get();

        return view('dashboard')->with(['periods' => $periods, 'notFinishedTasks' => $notFinishedTasks, 'organizations' => $organizations, 'seo' => $seo]);
    }

    public function city($city_id)
    {
        session(['city_id' => $city_id]);
        return redirect()->back();
    }

    private function getNowDateTitle()
    {
        $day = date("d");
        $month = mb_strtolower(Calendar::getTitleMonth(date("m"), true));
        $dayName = Carbon::now()->locale('ru')->dayName;


        return "Сегодня - $day $month, $dayName";
    }
}
