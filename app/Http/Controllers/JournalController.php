<?php

namespace App\Http\Controllers;

use App\Modules\BusinessTrips\BusinessTrip;
use App\Modules\BusinessTrips\BusinessTripRepository;
use App\Modules\Flash\Facades\Flash;
use App\Modules\Journals\{Journal, JournalRepository};
use App\Modules\Users\UserRepository;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    private $journalRepository;
    private $userRepository;
    private $businessTrip;

    public function __construct(JournalRepository $journalRepository, UserRepository $userRepository, BusinessTripRepository $businessTripRepository)
    {
        $this->journalRepository = $journalRepository;
        $this->userRepository    = $userRepository;
        $this->businessTrip      = $businessTripRepository;
    }

    public function all($monthId = null, $yearId = null)
    {
        $seo['title'] = 'Журнал посещений';
        $users = $this->userRepository->where(['is_client' => 0])->orderBy('name')->get();

        $monthsYears = $this->journalRepository->getMonthsYears();

        if($monthId == null)
        {
            $monthId = $monthsYears->last()->month_id;
            $yearId  = $monthsYears->last()->year_id;
        }

        $daysMonths  = $this->journalRepository->getDaysMonth($monthId, $yearId);
        $lastUsers   = $this->journalRepository->getLastUsers($monthId, $yearId);
        $businessTrips = $this->businessTrip->paginate();

        return view('journals.all')->with(['seo' => $seo, 'daysMonths' => $daysMonths, 'monthsYears' => $monthsYears, 'businessTrips' => $businessTrips,
                                            'users' => $users, 'lastUsers' => $lastUsers, 'showSidebar' => false]);
    }

    public function form($userId, $date)
    {
        $seo['title'] = 'Редактирование журнала';

        $journal = $this->journalRepository->where([['user_id', '=', $userId], ['date', '=', date('Y-m-d', strtotime($date))]])->first();

        return view('journals.save')->with(['journal' => $journal, 'seo' => $seo]);
    }

    public function save(Request $request, Journal $journal = null)
    {
        $this->journalRepository->save($request->all(), $journal);

        Flash::success('Запись успешно сохранена!');
        return redirect('journals');
    }


     public function saveBusinessTrip(Request $request, BusinessTrip $businessTrip = null)
     {
        $this->businessTrip->save($request->all(), $businessTrip);

        Flash::success('Командировка успешно сохранена!');
        return redirect('journals');
     }

    public function search(Request $request)
    {
        $seo['title'] = 'Результаты поиска : '.$request->input('locate');

        $journals = $this->journalRepository->search($request->input('locate'));
        $users = $this->userRepository->where(['is_client' => 0])->orderBy('name')->get();

        return view('journals.search')->with(['seo' => $seo, 'journals' => $journals, 'users' => $users]);
    }
}
