<?php

use App\Services\LeapSecondsService;
use App\Services\TimeConverterService;
use Carbon\Carbon;

class TimeConverterServiceTestTest extends TestCase
{

    public function testTimeConverter()
    {
        // More correct response should have 23:59:39 but because we use 69.184 leap seconds
        // this response is correct.

        $leapSecondsService = $this->createMock(LeapSecondsService::class);
        $leapSecondsService->method('forDate')
            ->willReturn(69.184);

        $converterService = new TimeConverterService($leapSecondsService);

        $this->assertEquals(
            $converterService->convert(new Carbon('2000-01-06 00:00:00')),
            [
                'MSD' => 44795,
                'MTC' => '23:59:44'
            ]
        );
    }
}
