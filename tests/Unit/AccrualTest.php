<?php

namespace Tests\Unit;

use App\Service\AccrualService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccrualTest extends TestCase
{

    /** @test */
    public function successfulCurlDepositTest()
    {
        $response = $this->get('/daily_accrual', [
            'unlimited'    => true
        ]);

        $response->assertStatus(200);
    }


}
