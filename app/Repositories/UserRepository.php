<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getUsersWithAccounts()
    {
        return User::with('accounts')->get();
    }

    /**
     * @return mixed
     */
    public function getUsersList()
    {
        return User::pluck('email', 'id');
    }

    /**
     * @param null $userId
     * @return array
     */
    public function getUserAccounts($userId = null)
    {
        if (! $userId) {
            return [];
        }

        $user = User::find($userId);

        $accounts = $user->accounts()->pluck('accounts.address', 'accounts.id')->all();

        $callback = function($key, $value) {
            return ['id' => $key, 'text' => $value];
        };

        $results = array_map($callback, array_keys($accounts), $accounts);

        return $results;
    }
}