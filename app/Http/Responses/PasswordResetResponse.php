<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\PasswordResetResponse as PasswordResetResponseContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportRedirects\Redirector;

class PasswordResetResponse implements PasswordResetResponseContract
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        $user = Auth::user();

        if ($user && $user->hasRole('user')) {
            return redirect()->to('/');
        }

        return redirect()->intended(filament()->getUrl());
    }
}