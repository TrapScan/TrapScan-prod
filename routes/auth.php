<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Models\Provider;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('/', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::get('/auth/{provider}/redirect', function ($provider) {
    $enabledProvdiers = ['google', 'facebook', 'apple'];
    if(in_array($provider, $enabledProvdiers)) {
        return Socialite::driver($provider)->stateless()->redirect();
    }
})->name('social_auth');


Route::get('/auth/{provider}/callback', function ($provider) {
    $enabledProvdiers = ['google', 'facebook'];
    if(in_array($provider, $enabledProvdiers)) {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid credentials']);
        }
        $existingUser = Provider::where('provider_id', $user->getId())->first();
        if($existingUser) {
            $existingUser = $existingUser->user()->first();
        }
        $alreadyUsedEmailCheck = User::where('email', $user->getEmail())->first();
        if($alreadyUsedEmailCheck) {
            $existingUser = $alreadyUsedEmailCheck;
        }
        if(! $existingUser) {
            $createUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => Hash::make(61),
                'settings' => User::DEFAULT_SETTINGS
            ]);
            if($createUser) {
                // Add the provider for this user so we can find them again with this account
                $provider = Provider::create([
                    'provider' => $provider,
                    'provider_id' => $user->getId(),
                    'user_id' => $createUser->id,
                    'avatar' => $user->getAvatar() ?? null
                ]);
                Auth::login($createUser);
                return redirect('/scan');
            }
        }
        // User exists, log them in
        Auth::login($existingUser);
        return redirect('/scan');
    }
    return back()->withErrors([
        'provider' => 'This provider is not supported.'
    ]);
});

Route::post('/auth/{provider}/callback', function (Request $request, $provider) {
    $enabledProvdiers = ['apple'];
    $request->validate([
        'code' => 'required'
    ]);
    if(in_array($provider, $enabledProvdiers)) {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid credentials', 'exception' => $e->getMessage(), 'code' => $e->getCode()]);
        }
        $existingUser = Provider::where('provider_id', $user->getId())->first();
        if($existingUser) {
            $existingUser = $existingUser->user()->first();
        }
        if(! $existingUser) {
            $createUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail() ,
                'password' => Hash::make(61),
                'settings' => User::DEFAULT_SETTINGS
            ]);
            if($createUser) {
                // Add the provider for this user so we can find them again with this account
                $provider = Provider::create([
                    'provider' => $provider,
                    'provider_id' => $user->getId(),
                    'user_id' => $createUser->id,
                    'avatar' => $user->getAvatar() ?? null
                ]);
                Auth::login($createUser);
                return redirect('/scan');
            }
        }
        // User exists, log them in
        Auth::login($existingUser);
        return redirect('/scan');
    }
    return back()->withErrors([
        'provider' => 'This provider is not supported.'
    ]);
});
