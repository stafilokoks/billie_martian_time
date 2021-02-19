<?php

use App\Services\LeapSecondsService;
use App\Services\TimeConverterService;
use Carbon\Carbon;

class LeapSecondsServiceTest extends TestCase
{
    public function testLeapSecondsService()
    {
        $leapSecondsService = new LeapSecondsService();

        $this->assertEquals(
            $leapSecondsService->forDate(new Carbon('2000-01-06T00:00:00Z')),
            64.184
        );
    }
}
