<?php

namespace App\Http\Controllers;

use App\Events\AccountDeposit;
use App\Models\Account;
use App\Models\User;
use App\Repositories\AccountRepository;
use App\Repositories\UserRepository;
use App\Requests\DepositRequest;
use App\Service\AccountService;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    protected $userRepository;

    protected $accountRepository;

    protected $accountService;

    public function __construct()
    {
        $this->userRepository = new UserRepository();

        $this->accountRepository = new AccountRepository();

        $this->accountService = new AccountService();
    }

    public function index()
    {
        return view('pages.deposit');
    }

    public function getUserAccounts(Request $request)
    {
        return response()->json([
            'result' => $this->userRepository->getUserAccounts($request->get('user_id'))
        ]);
    }

    public function postDeposit(DepositRequest $request)
    {
        return $this->accountService->makeDeposit($request->all());
    }
}
