@extends('layouts.app')
@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@section('content')
    <h1>User Register Page</h1>
    <div class="register-box" style="margin: auto">
        <form action="{{ $register_url }}" method="post">
            {{ csrf_field() }}

            {{-- RoleOwnerships field --}}
            <div class="input-group mb-3 justify-content-center border" style="border-radius: .25rem">
                <strong>アカウントに付与する権限(複数可)</strong>
                <ul class="list-unstyled">
                    @foreach(Roles::getKeys() as $key)
                        @if(Roles::HANDLER !== Roles::getValue($key))
                            <li class="form-check">
                                <label class="form-check-label"
                                       for="{{ strtolower($key) }}">
                                    <input type="checkbox" name="{{strtolower($key)}}" id="{{strtolower($key)}}"
                                           class="form-check-input {{ $errors->has('role') ? 'is-invalid' : '' }}">
                                    {{ Roles::getLabels()[Roles::getValue($key)] }}
                                    <span class="fas {{ Roles::getIcons()[Roles::getValue($key)] }} {{ config('adminlte.classes_auth_icon', '') }}">
                    </span>
                                </label>
                            </li>
                        @endif
                    @endforeach
                    @if($errors->has(strtolower($key)))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first(strtolower($key)) }}</strong>
                        </div>
                    @endif
                </ul>
            </div>

            {{-- Name field --}}
            <div class="input-group mb-3">
                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                       value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </div>
                @endif
            </div>

            {{-- Email field --}}
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                       value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
            </div>

            {{-- Password field --}}
            <div class="input-group mb-3">
                <input type="password" name="password"
                       class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                       placeholder="{{ __('adminlte::adminlte.password') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </div>
                @endif
            </div>

            {{-- Confirm password field --}}
            <div class="input-group mb-3">
                <input type="password" name="password_confirmation"
                       class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                       placeholder="{{ __('adminlte::adminlte.retype_password') }}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                    </div>
                </div>
                @if($errors->has('password_confirmation'))
                    <div class="invalid-feedback">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </div>
                @endif
            </div>

            {{-- Register button --}}
            <button type="submit"
                    class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
                <span class="fas fa-user-plus"></span>
                {{ __('adminlte::adminlte.register') }}
            </button>

        </form>
    </div>
@endsection
