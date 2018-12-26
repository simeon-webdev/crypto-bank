<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepositRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user' => 'required|exists:users,id',
            'account' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
        ];
    }
}
