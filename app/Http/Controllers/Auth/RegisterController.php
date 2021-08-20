<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Roles;
use App\Enums\RoleStatuses;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data): User
    {
        $roleData = array_intersect_key(
            $data,
            array_flip(Roles::getLowerKeys())
        );
        $roles = [];
        $truthKeys = [];
        foreach ($roleData as $key => $value) {
            $columnName = strtolower($key);
            if ($value === 'on') {
                $truthKeys[] = $columnName;
                // 権限あり
                $roles[$columnName] = RoleStatuses::ENABLED;
            } else {
                // 権限なし
                $roles[$columnName] = RoleStatuses::DISABLED;
            }
        }
        $enabledRoleValue = 9;
        if (count($truthKeys) > 0) {
            $truthKey = $truthKeys[0];
            $enabledRoleValue = Roles::getValue(strtoupper($truthKey));
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 付与された権限のうち１つだけ選択する
            'role' => $enabledRoleValue,
        ]);

        $user->find($userId = $user->id)->rolesOwnership()->create(
            array_merge(['id' => $userId], $roles)
        );

        return $user;
    }
}
