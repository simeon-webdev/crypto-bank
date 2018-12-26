<?php

namespace App\Repositories;

use App\Events\DailyAccrualStatus;
use App\Models\Account;
use App\Models\AccrualLog;
use App\Service\LoggerService;
use App\Services\MathService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AccountRepository
{
    protected $loggerService;

    protected $mathService;

    public function __construct()
    {
        $this->loggerService = new LoggerService();

        $this->mathService = new MathService();
    }

    public function getAccountsWithUsers()
    {
        return Account::with('user', 'interestRate')->get();
    }

    /**
     * @param bool $unlimited
     * @return bool
     */
    public function accrualAccountBalances($unlimited = false)
    {
        $log = AccrualLog::whereDate('created_at', Carbon::today())
            ->where('status', config('constants.accrual_log_status.success'))
            ->get();

        //If there is already a log for accrual today skip the script
        if (! $log->isEmpty() && ! $unlimited) {
            return false;
        }

        event(new DailyAccrualStatus('start'));

        DB::beginTransaction();

        try {

            $balancesTotalBefore = Account::where('balance', '>', 0)
                ->where('interest_rate_id', '>', 0)->sum('balance');

            $updatedAccountsCount = DB::table('accounts')
                ->select([
                    'accounts.id',
                    'accounts.interest_rate_id',
                    'accounts.balance',
                    'accounts.accrual_date',
                    'interest_rates.percent as percent'
                ])
                ->join('interest_rates', 'accounts.interest_rate_id', '=', 'interest_rates.id')
                ->where('balance', '>', 0)
                ->where('interest_rate_id', '>', 0)
                ->lockForUpdate()
                ->update([
                    'balance' => DB::raw('ROUND(balance + (balance * percent / 100), 2)'),
                    'accrual_date' => Carbon::now()
                ]);


            $balancesTotalAfter = Account::where('balance', '>', 0)
                ->where('interest_rate_id', '>', 0)->sum('balance');

            $difference = $this->mathService->formatNumber($balancesTotalAfter - $balancesTotalBefore);

            $this->loggerService->createAccrualLog(
                config('constants.accrual_log_status.success'),
                $updatedAccountsCount,
                $difference
            );

            $updatedAccounts = Account::get();

            DB::commit();

            return $updatedAccounts;

        } catch (\Exception $e) {

            DB::rollback();
            return false;
        }
    }

}
