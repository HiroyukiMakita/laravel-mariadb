<li class="nav-item dropdown user-menu">
    @php($userRoles = $user->roles()->first()->toArray())
    @php($roleSwitchable = count(array_filter($userRoles, static function($role) {return $role === \App\Enums\RoleStatuses::DISABLED;})) > 0)

    @if(!$roleSwitchable)
        {{-- Role is only screen --}}
        <span class="nav-link dropdown-toggle" style="pointer-events: none">
            {{ Roles::getLabels()[$user->role] }}
            <span class="fas {{ Roles::getIcons()[$user->role] }}"></span>
        </span>

    @else
        {{-- Role switcher --}}
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            {{ Roles::getLabels()[$user->role] }}
            <span class="fas {{ Roles::getIcons()[$user->role] }}"></span>
        </a>

        {{-- User menu dropdown --}}
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            {{-- User menu footer --}}
            <li class="user-footer">
                権限を切り替える
                @foreach($userRoles as $key => $role)
                    @if($role === \App\Enums\RoleStatuses::DISABLED)
                        <a class="btn btn-default btn-flat float-right btn-block"
                           onclick="document.getElementById('role-switch-form-{{$key}}').submit();">
                            <span class="fas {{ Roles::getIcons()[\App\Enums\Roles::getValue(strtoupper($key))] }}"></span>
                            {{ Roles::getLabels()[\App\Enums\Roles::getValue(strtoupper($key))] }}
                        </a>
                        <form id="role-switch-form-{{$key}}" action="{{route('role-change')}}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                            <input type="hidden" name="current_role"
                                   value="{{strtolower(Roles::getKey($user->role))}}"/>
                            <input type="hidden" name="next_role" value="{{$key}}"/>
                        </form>
                    @endif
                @endforeach
            </li>
        </ul>
    @endif
</li>
