<?php

use App\User;
use App\Token;
use App\Mail\TokenMail;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends FeatureTestCase
{
    function test_a_user_can_create_an_account()
    {
        Mail::fake();

        $this->visit('register')
            ->type('admin@mail.com', 'email')
            ->type('juarisco', 'username')
            ->type('John', 'first_name')
            ->type('Doe', 'last_name')
            ->press('Regístrate');

        $this->seeInDatabase('users', [
            'email' => 'admin@mail.com',
            'username' => 'juarisco',
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        $user = User::first();

        $this->seeInDatabase('tokens', [
            'user_id' => $user->id
        ]);

        $token = Token::where('user_id', $user->id)->first();

        $this->assertNotNull($token);

        Mail::assertSentTo($user, TokenMail::class, function ($mail) use ($token) {
            return $mail->token->id == $token->id;
        });

        // todo: finish this feature!
        // return;

        $this->seeRouteIs('register_confirmation')
            ->see('Gracias por registrarte')
            ->see('Eviamos a tu email un enlace para que inicies sesión');
    }
}
