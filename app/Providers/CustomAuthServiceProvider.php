<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use function app\Helpers\decrypt_column;

class CustomAuthServiceProvider extends EloquentUserProvider
{
    /**
     * @override
     * Retrieve a user by the given credentials.
     * @param array $credentials
     * @return Builder|Model|object|void|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                Str::contains($this->firstCredentialKey($credentials), 'password'))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } else {
                // ここだけ修正（復号化）
                $query->whereRaw(decrypt_column($key) . ' = ?', [$value]);
            }
        }

        return $query->first();
    }
}
