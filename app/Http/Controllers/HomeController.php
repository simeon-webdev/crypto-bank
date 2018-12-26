<?php

namespace App\Http\Controllers;

use App\Events\DailyAccrual;
use App\Repositories\AccountRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Event;

class HomeController extends Controller
{
    protected $userRepository;

    protected $accountRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();

        $this->accountRepository = new AccountRepository();
    }

    public function index()
    {
        $accounts = $this->accountRepository->getAccountsWithUsers();

        $usersList = $this->userRepository->getUsersList();

        return view('pages.homepage', [
            'accounts' => $accounts,
            'usersList' => $usersList
        ]);
    }
}