<?php


namespace App\Services;


use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

/**
 * This service processed leap seconds data from
 * https://www.ietf.org/timezones/data/leap-seconds.list
 */
class LeapSecondsService
{
    const LIST_URL = 'https://www.ietf.org/timezones/data/leap-seconds.list';

    /**
     * @param Carbon $date
     * @return float
     * @throws ConnectionException
     */
    public function forDate(Carbon $date) : float
    {
        $response = Http::get(LeapSecondsService::LIST_URL);
        if($response->failed()){
            throw new ConnectionException('Leap seconds service is unavailable');
        }

        $secondsList = $this->prepareList($response->body());
        foreach ($secondsList as $line){
            if($date->getTimestamp() > $line[0]){
                return $line[1] + 32.184;
            }
        }

        // 32.184 split seconds was before 1 Jan 1972
        return 32.184;
    }

    /**
     * @param string $data
     * @return array
     */
    private function prepareList(string $data) : array
    {
        $secondsArray = [];

        foreach(preg_split("/((\r?\n)|(\r\n?))/", $data) as $line){
            if(substr($line, 0, 1) != '#'){
                if(trim($line)){
                    $secondsArray[] = explode("\t", $line);
                }
            }
        }
        return array_reverse(
            array_map(function($line){
                // Count of seconds between 1 Jan
                $line[0] = $line[0] - 2208988800;
                return $line;
            }, $secondsArray)
        );
    }
}
