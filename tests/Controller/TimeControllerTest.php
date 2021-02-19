<?php

class TimeControllerTest extends TestCase
{
    public function testBaseRequest()
    {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }

    public function testGetConvertPass()
    {
        $this->get('/convert?date=2000-01-06T00:00:00Z')
            ->seeJson(['MSD' => 44795, 'MTC' => '23:59:39']);
    }

    public function testGetConvertFail()
    {
        $this->get('/convert')
            ->seeJson(['date' => ['The date field is required.']
            ]);

        $this->get('/convert?date=wrongDate')
            ->seeJson(['date' => ['The date does not match the format Y-m-d\\TH:i:s\\Z.']
            ]);
    }
}
