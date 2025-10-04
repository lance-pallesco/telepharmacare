<?php

namespace App\Filament\Auth;

use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

class Login extends BaseLogin
{
    public function authenticate(): ?LoginResponse
    {
        parent::authenticate();
        return app(RoleBasedLoginResponse::class);
    }
}
