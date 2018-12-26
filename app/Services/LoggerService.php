<?php

namespace App\Service;


use App\Repositories\LoggerRepository;

class LoggerService
{
    protected $loggerRepository;

    public function __construct()
    {
        $this->loggerRepository = new LoggerRepository();
    }

    public function createDepositLog($accountId = null, $amount = null)
    {
        try {
            if ($accountId && $amount) {
                $this->loggerRepository->createDepositLog([
                    'account_id' => $accountId,
                    'amount' => $amount
                ]);

                return true;
            }
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }

    public function createAccrualLog($status = null, $accounts_count = null, $amount = null)
    {
        try {
            if ($status && $accounts_count) {
                $this->loggerRepository->createAccrualLog([
                    'status' => $status,
                    'accounts_count' => $accounts_count,
                    'amount' => $amount
                ]);

                return true;
            }
        } catch (\Exception $exception) {
            throw new $exception;
        }
    }
}
