<?php

namespace App\Http\Controllers\Auth\Role;

use App\Enums\Roles;
use App\Enums\RoleStatuses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Role\ChangeRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ChangeController extends Controller
{
    /**
     * @param ChangeRequest $request
     * @return RedirectResponse
     */
    public function __invoke(ChangeRequest $request): RedirectResponse
    {
        $userId = Auth::id();
        $nextRoleKey = $request->getnextRoleKey();
        $user = User::with('rolesOwnership')->findOrFail($userId);
        $disabledRoleStatus = RoleStatuses::DISABLED;
        if (($user->rolesOwnership->$nextRoleKey ?? $disabledRoleStatus) === $disabledRoleStatus) {
            return Redirect::back();
        }
        $user->role = Roles::getValue(strtoupper($nextRoleKey));
        $user->save();
        return Redirect::back();
    }
}
