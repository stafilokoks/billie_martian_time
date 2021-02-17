<?php

use App\Services\LeapSecondsService;
use App\Services\TimeConverterService;
use Carbon\Carbon;

class LeapSecondsServiceTest extends TestCase
{
    public function testLeapSecondsService()
    {
        // Right now LeapSecondsProvider just return static value
        // of leap seconds of the 2021 year, so date we send can be any.
        $leapSecondsService = new LeapSecondsService();

        $this->assertEquals(
            $leapSecondsService->forDate(new Carbon()),
            69.184
        );
    }
}
