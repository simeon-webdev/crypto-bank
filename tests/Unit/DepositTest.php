<?php

namespace Tests\Unit;

use App\Models\Account;
use App\Service\AccountService;
use Tests\TestCase;

class DepositTest extends TestCase
{
    /** @test */
    public function successfulDepositTest()
    {
        $accoundService = new AccountService();

        $data = [
            'user'      => 1,
            'account'   => 1,
            'amount'    => 100
        ];

        $response = $accoundService->makeDeposit($data);

        $account = Account::find(1);

        $this->assertEquals($response->content(),
            '"Successfully added \"100\" BGN to \"'.$account->address.'\""');
    }

    /** @test */
    public function failedDepositTest()
    {
        $accoundService = new AccountService();

        $data = [
            'user'      => 1,
            'amount'    => 100
        ];

        $response = $accoundService->makeDeposit($data);


        $this->assertEquals($response->content(),
            '"Undefined index: account"');
    }

    /** @test */
    public function successfulCurlDepositTest()
    {
        $response = $this->post('/deposit', [
            'user'      => 1,
            'account'   => 1,
            'amount'    => 100
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function failedCurlDepositTest()
    {
        $response = $this->post('/deposit', [
            'account'   => 1,
            'amount'    => 100
        ]);


        $response->assertStatus(302);
    }
}
