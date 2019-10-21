<?php

namespace App\Modules\Calendar;

use Illuminate\Support\Carbon;

class Day
{
   public $day;
   public $isWeekEnd = false;

   public function __construct($day = null)
   {
       $this->day = $day;

   }
}