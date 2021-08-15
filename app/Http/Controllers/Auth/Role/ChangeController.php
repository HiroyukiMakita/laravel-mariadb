<?php

namespace App\Http\Controllers\Auth\Role;

use App\Enums\Roles;
use App\Enums\RoleStatuses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Role\ChangeRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ChangeController extends Controller
{
    public function __invoke(ChangeRequest $request)
    {
        $userId = Auth::id();
        $currentRoleKey = $request->getCurrentRoleKey();
        $nextRoleKey = $request->getnextRoleKey();
        $user = User::with('roles')->find($userId);
        $user->role = Roles::getValue(strtoupper($nextRoleKey));
        $user->roles->$currentRoleKey = RoleStatuses::DISABLED;
        $user->roles->$nextRoleKey = RoleStatuses::ENABLED;
        $user->save();
        $user->roles->save();
        return Redirect::back();
    }
}
