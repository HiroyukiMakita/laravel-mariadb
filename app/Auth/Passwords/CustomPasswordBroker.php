<?php

namespace App\Auth\Passwords;

use App\Providers\CustomAuthServiceProvider;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;


class CustomPasswordBroker extends PasswordBroker
{
    /**
     * Create a new password broker instance.
     *
     * @param TokenRepositoryInterface $tokens
     * @param CustomAuthServiceProvider $users
     * @return void
     */
    public function __construct(TokenRepositoryInterface $tokens, CustomAuthServiceProvider $users)
    {
        parent::__construct($tokens, $users);
        $this->users = $users;
        $this->tokens = $tokens;
    }
}