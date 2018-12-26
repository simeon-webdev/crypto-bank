<?php

namespace App\Repositories;

use App\Models\AccrualLog;
use App\Models\DepositLog;
use Carbon\Carbon;

class LoggerRepository
{
    public function createDepositLog($data = [])
    {
        return DepositLog::create($data);
    }

    public function createAccrualLog($data = [])
    {
        return AccrualLog::create($data);
    }

    public function getDepositLog()
    {
        if (env('REPORT_DAY') == 'today') {
            return DepositLog::whereDate('created_at', Carbon::today())->get();
        } else {
            return DepositLog::whereDate('created_at', Carbon::yesterday())->get();
        }
    }

    public function getAccrualLog()
    {
        $query = AccrualLog::where('status', config('constants.accrual_log_status.success'));

        if (env('REPORT_DAY') == 'today') {
            $query = $query->whereDate('created_at', Carbon::today());
        } else {
            $query = $query->whereDate('created_at', Carbon::yesterday());
        }

        return $query->first();
    }
}
