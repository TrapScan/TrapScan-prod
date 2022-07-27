<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagicLoginRequest;
use App\Mail\MagikLogin;
use Illuminate\Http\Request;
use App\Models\User;
use Grosv\LaravelPasswordlessLogin\LoginUrl;


class OtherAuthController extends Controller
{
    function sendLoginLink(MagicLoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        if ($user === null){
            session()->flash('message','Can\'t find user with e-mail '.$request->email);
            return back();
        }
        $generator = new LoginUrl($user);
        $generator->setRedirectUrl(route('scan')); // Override the default url to redirect to after login
        $url = $generator->generate();
        \Mail::to($user->email)
            ->send(new MagikLogin($url));

        session()->flash('message','Check your e-mail');
        return back();
    }
}
