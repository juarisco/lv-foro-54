<?php

namespace App\Http\Controllers;

use App\Token;

class LoginController extends Controller
{
    public function login($token)
    {
        $token = Token::findActive($token);

        if ($token == null) {
            alert('Este enlace ya expiró, por favor solicita otro', 'danger');

            return redirect()->route('token');
        }

        $token->login();

        return redirect('/');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();

        alert('Hasta pronto!');

        return redirect('/');
    }
}
