<?php


namespace App\Components;


use Carbon\Carbon;

class LeapSecondsProvider
{
    /**
     * This service should return the difference in seconds
     * between UTC and TAI for the provided date.
     * Because we didn't know, how much leap seconds will be added until 2120
     * I just return the actual value for the firs half of 2021
     *
     * @param Carbon $date
     * @return float
     */
    static function forDate(Carbon $date) : float
    {
        return 37 + 32.184;
    }
}
