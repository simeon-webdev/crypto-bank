<?php

namespace Tests\Unit;

use App\Service\LoggerService;
use Illuminate\Database\QueryException;
use PHPUnit\Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoggerTest extends TestCase
{
    /** @test */
    public function successfulAccrualLogTest()
    {
        $loggerService = new LoggerService();

        $response = $loggerService->createAccrualLog(
            config('constants.accrual_log_status.success'),
            10,
            1000
        );

        $this->assertEquals($response, true);
    }

    /** @test */
    public function successfulDepositLogTest()
    {
        $loggerService = new LoggerService();

        $response = $loggerService->createDepositLog(
            1,
            11.11
        );

        $this->assertEquals($response, true);
    }
}
