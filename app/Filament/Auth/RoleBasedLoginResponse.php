<?php
namespace App\Filament\Auth;

use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Illuminate\Support\Facades\Auth;

class RoleBasedLoginResponse implements LoginResponse
{
    public function toResponse($request)
    {
        $user = Auth::user();
        // Determine redirect URL based on role
        $redirectUrl = match ($user->role) {
            'admin' => '/app/admin',
            'pharmacist' => '/app/pharmacist',
            'patient' => '/app/patient',
            default => '/app',
        };

        return redirect()->intended($redirectUrl);
    }
}