<?php

namespace Tests\Unit;

use App\Service\ReportService;
use Tests\TestCase;

class ReportTest extends TestCase
{
    /** @test */
    public function reportTest()
    {
        $reportService = new ReportService();

        $response = $reportService->generateReport();

        $this->assertArrayHasKey('date', $response);
        $this->assertArrayHasKey('depositsCount', $response);
        $this->assertArrayHasKey('depositAmountBgn', $response);
        $this->assertArrayHasKey('depositAmountUsd', $response);
        $this->assertArrayHasKey('accruedAccounts', $response);
        $this->assertArrayHasKey('accruedAmountBgn', $response);
        $this->assertArrayHasKey('accruedAmountUsd', $response);
    }
}
