<?php

namespace App\Service;


use App\Events\AccountDeposit;
use App\Models\Account;

class AccountService
{
    protected $loggerService;

    public function __construct()
    {
        $this->loggerService = new LoggerService();
    }

    public function makeDeposit($request)
    {
        try {
            $account = Account::find($request['account']);

            $account->balance += $request['amount'];

            $account->save();

            $this->loggerService->createDepositLog($account->id, $request['amount']);

            event(new AccountDeposit($account));

            return response()->json('Successfully added "' . $request['amount'] . '" BGN to "'
                . $account->address . '"'
            );
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }
}
