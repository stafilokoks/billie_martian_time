<?php


namespace App\Services;


use Carbon\Carbon;

class LeapSecondsService
{
    /**
     * This service should return the difference in seconds
     * between UTC and TAI for the provided date.
     * Because we didn't know, how much leap seconds will be added until 2120
     * we just use the actual value for the firs half of 2021
     *
     * @param Carbon $date
     * @return float
     */
    public function forDate(Carbon $date) : float
    {
        return 37 + 32.184;
    }
}
