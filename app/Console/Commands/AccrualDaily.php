<?php

namespace App\Console\Commands;

use App\Service\AccrualService;
use Illuminate\Console\Command;

class AccrualDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accrual:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily accrual of account balances!';

    /**
     * @var
     */
    protected $accrualService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->accrualService = new AccrualService();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        return $this->accrualService->dailyAccrualAllAccounts();
    }
}
