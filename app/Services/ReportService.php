<?php

namespace App\Service;

use App\Repositories\LoggerRepository;
use App\Services\MathService;
use Carbon\Carbon;

class ReportService
{
    protected $loggerRepository;

    protected $mathService;

    public function __construct()
    {
        $this->loggerRepository = new LoggerRepository();

        $this->mathService = new MathService();
    }

    public function generateReport()
    {
        try {
            $depositLog = $this->loggerRepository->getDepositLog();

            $accrualLog = $this->loggerRepository->getAccrualLog();

            if (env('REPORT_DAY') == 'today') {
                $date = Carbon::today()->format('d-m-Y');
            } else {
                $date = Carbon::yesterday()->format('d-m-Y');
            }

            $accrualsAmount = $accrualLog->amount ?? 0;
            $depositsAmount = $depositLog->sum('amount') ?? 0;


            return [
                'date'              => $date,
                'depositsCount'     =>   $depositLog->count(),
                'depositAmountBgn'  => $this->mathService->formatNumber($depositsAmount),
                'depositAmountUsd'  => $this->mathService->currencyConversion($depositsAmount),
                'accruedAccounts'   => $accrualLog->accounts_count ?? 0,
                'accruedAmountBgn'  => $this->mathService->formatNumber($accrualsAmount),
                'accruedAmountUsd'  => $this->mathService->currencyConversion($accrualsAmount)
            ];
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }
}
