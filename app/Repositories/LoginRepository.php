<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\LoginRepositoryInterface;

class LoginRepository implements LoginRepositoryInterface
{
    public function login($data_user){
        return User::all();
    }
}