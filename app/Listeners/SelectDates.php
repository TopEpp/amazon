<?php

namespace App\Listeners;

use App\Events\SwitchDates;
use Carbon\Carbon;

class SelectDates
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SwitchDates $event)
    {
        switch ($event->input) {
            case 'today':
                $today = new Carbon('today');
                $today = new Carbon('today');
                $date = [$today->format('Y-m-d').' '.'00:00:00', $today->format('Y-m-d').' '.'00:00:00'];
                break;
            case 'month':
                $month_first = new Carbon('first day of this month');
                $month_last = new Carbon('last day of this month');
                $date = [$month_first->format('Y-m-d').' '.'00:00:00', $month_last->format('Y-m-d').' '.'00:00:00'];
                break;
            case 'year':
                $year = new Carbon('this year');
                $last_year = new Carbon('last year');
                $date = [$last_year->format('Y-m-d').' '.'00:00:00', $year->format('Y-m-d').' '.'00:00:00'];
                break;

            default:
                $week_first = new Carbon('this week');
                $week_last = new Carbon('last week');
                $date = [$week_last->format('Y-m-d').' '.'00:00:00', $week_first->format('Y-m-d').' '.'00:00:00'];
                break;
        }
        return $date;
    }
}
