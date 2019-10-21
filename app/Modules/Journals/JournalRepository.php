<?php

namespace App\Modules\Journals;

use App\Modules\Repositories\Repository;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JournalRepository extends Repository
{
	public function model()
	{
		return Journal::class;
	}

	public function getDaysMonth($monthId, $yearId)
    {
        return DB::table('journals')
            ->select('date')
            ->whereMonth('date', $monthId)
            ->whereYear ('date', $yearId)
            ->orderBy('date')
            ->distinct()
            ->get();
    }

    public function getLastUsers($monthId, $yearId)
    {
        return Journal::whereMonth('date', $monthId)->whereYear('date', $yearId)->groupBy('user_id')->get('user_id');
    }

    public function getMonthsYears()
    {
        return DB::table('journals')
            ->select(DB::raw('MONTH(date) as month_id, YEAR(date) as year_id'))
            ->distinct()
            ->get();
    }

    public function search($locate)
    {
        return Journal::select(DB::raw('user_id, group_concat(date) as dates'))
            ->where('locate', 'LIKE', "%{$locate}%")
            ->groupBy('user_id')
            ->get();
    }
}
