<?php

namespace App\Services;

use App\Service\ApiCallerService;

class MathService {

    protected $apiCallerService;

    public function __construct()
    {
        $this->apiCallerService = new ApiCallerService();
    }

    public function formatNumber($number = 0, $decimals = 2)
    {
        return number_format($number, $decimals);
    }

    public function currencyConversion($amount, $currency = 'USD')
    {
        $dailyCourses = $this->apiCallerService->get('http://data.fixer.io/api/latest');

        $amountEUR = $amount / $dailyCourses->rates->BGN;

        return number_format($amountEUR * $dailyCourses->rates->{$currency}, 2);
    }

}
