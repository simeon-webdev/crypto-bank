<?php

namespace App\Http\Controllers;

use App\Service\AccrualService;
use Illuminate\Http\Request;

class AccrualController extends Controller
{
    protected $accrualService;

    public function __construct()
    {
        $this->accrualService = new AccrualService();
    }

    public function dailyAccrual(Request $request)
    {
        $unlimited = $request->get('unlimited') ?? false;

        $this->accrualService->dailyAccrualAllAccounts($unlimited);

        return;
    }
}
