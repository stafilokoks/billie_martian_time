<?php


namespace App\Services;


use Carbon\Carbon;

class TimeConverterService
{
    /**
     * @var LeapSecondsService
     */
    private $leapSecondsService;

    /**
     * TimeConverterService constructor.
     * @param LeapSecondsService $leapSecondsService
     */
    public function __construct(LeapSecondsService $leapSecondsService)
    {
        $this->leapSecondsService = $leapSecondsService;
    }

    /**
     * @param Carbon $date
     * @return array
     */
    public function convert(Carbon $date) : array
    {
        $marsSolDays = $this->getSols($date);
        $coordinatedMarsTime = $this->getMarsTime($marsSolDays);

        return [
            'MSD' => (int)$marsSolDays,
            'MTC' => Carbon::createFromTimestampMs($coordinatedMarsTime * 3600000)->toTimeString(),
        ];
    }

    /**
     * @param Carbon $date
     * @return float
     */
    private function getSols(Carbon $date) : float
    {
        $jDateUT = ( $date->getPreciseTimestamp(3) / 86400000 ) + 2440587.5;
        $jDateTT = $jDateUT + ($this->leapSecondsService->forDate($date) / 86400);

        //Days since J2000
        $dTj2000 = $jDateTT - 2451545;

        return (($dTj2000 - 4.5) / 1.027491252 ) + 44796 - 0.00096;
    }

    /**
     * @param float $marsSolDays
     * @return float
     */
    private function getMarsTime(float $marsSolDays) : float
    {
        return fmod(24 * $marsSolDays, 24);
    }
}
