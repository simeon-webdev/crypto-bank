<?php

namespace App\Service;

use App\Events\DailyAccrual;
use App\Events\Report;
use App\Repositories\AccountRepository;

class AccrualService
{
    protected $accountRepository;

    protected $reportService;

    public function __construct()
    {
        $this->accountRepository = new AccountRepository();

        $this->reportService = new ReportService();
    }

    public function dailyAccrualAllAccounts($unlimited = false)
    {
        if (! $updatedAccounts = $this->accountRepository->accrualAccountBalances($unlimited)) {
            return false;
        }

        $report = $this->reportService->generateReport();

        event(new DailyAccrual($updatedAccounts));
        event(new Report($report));

        return true;
    }
}
