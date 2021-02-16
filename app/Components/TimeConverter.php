<?php


namespace App\Components;


use Carbon\Carbon;

class TimeConverter
{
    /**
     * @param Carbon $date
     * @return array
     */
    static function convertTime(Carbon $date) : array
    {
        $jDateUT = ( $date->getPreciseTimestamp(3) / 86400000 ) + 2440587.5;
        $jDateTT = $jDateUT + (LeapSecondsProvider::forDate($date) / 86400);

        //Days since J2000
        $dTj2000 = $jDateTT - 2451545;

        $marsSolDays = (($dTj2000 - 4.5) / 1.027491252 ) + 44796 - 0.00096;
        $coordinatedMarsTime = fmod(24 * $marsSolDays, 24);

        return [
            'MSD' => (int)$marsSolDays,
            'MTC' => Carbon::createFromTimestampMs($coordinatedMarsTime * 3600000)->toTimeString(),
        ];
    }
}
