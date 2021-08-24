<?php

namespace App\Auth\Passwords;

use Closure;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use InvalidArgumentException;


class CustomPasswordBrokerManager extends PasswordBrokerManager
{
    protected function resolve($name): CustomPasswordBroker
    {
        $config = $this->getConfig($name);
        if (is_null($config)) {
            throw new InvalidArgumentException("Password resetter [{$name}] is not defined.");
        }
        return new CustomPasswordBroker(
            $this->createTokenRepository($config),
            $this->app['auth']->createUserProvider($config['provider'] ?? null)
        );
    }

    public function sendResetLink(array $credentials)
    {
        // TODO: Implement sendResetLink() method.
    }

    public function reset(array $credentials, Closure $callback)
    {
        // TODO: Implement reset() method.
    }
}