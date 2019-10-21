<?php

namespace App\Modules\Calendar;

use Illuminate\Support\Carbon;

class Calendar
{
    const COUNT_MONTH_IN_PERIOD = 2;

    /**
     * Возвращает прошлый, текущий, следующий месяц
     * @param int $countMonth
     * @return array
     */
    public static function getPeriods($countMonth = self::COUNT_MONTH_IN_PERIOD)
    {
        $periods = [];

        $month = Carbon::now()->locale('ru')->subMonth();

        for($i = 0; $i < $countMonth + 1; $i++)
        {
            $periods [] = ['title' => $month->monthName,  'month_id' => $month->month, 'year_id' => $month->year];

            $month->addMonth();
        }

       return $periods;
    }


    public static function getMonth ($monthId, $yearId)
    {
        $days = [];
        $month = Carbon::create($yearId, $monthId);
        $dayOfWeek = $month->dayOfWeek;

        for($i = 1; $i <= $month->daysInMonth; $i++ )
        {
            if ($i < $dayOfWeek)
                array_unshift($days, new Day());

            $days[] = new Day($i);
        }

        return array_chunk ($days, 7);

    }

    public static function getTitleMonth($month_id, $isDeclension = false)
    {
        if ($month_id == 1)
            return $isDeclension ? 'Января' : 'Январь';

        if ($month_id == 2)
            return $isDeclension ? 'Февраль' :'Февраль';

        if ($month_id == 3)
            return $isDeclension ? 'Марта' :'Март';

        if ($month_id == 4)
            return $isDeclension ? 'Апреля' : 'Апрель';

        if ($month_id == 5)
            return $isDeclension ? 'Мая' : 'Май';

        if ($month_id == 6)
            return $isDeclension ?' Июня' : 'Июнь';

        if ($month_id == 7)
            return $isDeclension ? 'Июля' : 'Июль';

        if ($month_id == 8)
            return $isDeclension ? 'Августа' : 'Август';

        if ($month_id == 9)
            return $isDeclension ? 'Сентября' : 'Сентябрь';

        if ($month_id == 10)
            return $isDeclension ? 'Октября' : 'Октябрь';

        if ($month_id == 11)
            return $isDeclension ? 'Ноября' : 'Ноябрь';

        if ($month_id == 12)
            return $isDeclension ? 'Декабря' : 'Декабрь';
    }
}