<?php

use App\Components\LeapSecondsProvider;
use App\Components\TimeConverter;
use Carbon\Carbon;

class AppTest extends TestCase
{

    public function testLeapSecondsProvider()
    {
        // Right now LeapSecondsProvider just return static value
        // of leap seconds of the 2021 year, so date we send can be any.
        $this->assertEquals(
            LeapSecondsProvider::forDate(new Carbon()),
            69.184
        );
    }

    public function testTimeConverter()
    {
        // More correct response should have 23:59:39 but because we use 69.184 leap seconds
        // this response is correct.
        $this->assertEquals(
            TimeConverter::convertTime(new Carbon('2000-01-06 00:00:00')),
            [
                'MSD' => 44795,
                'MTC' => '23:59:44'
            ]
        );
    }

    public function testBaseRequest()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }

    public function testPostTime()
    {
        $this->post('/time', [])
            ->seeJson(['date' => ['The date field is required.']
            ]);

        $this->post('/time', ['date' => '2000-01-06 00:00:00'])
            ->seeJson(['MSD' => 44795, 'MTC' => '23:59:44']);
    }
}
