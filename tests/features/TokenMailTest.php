<?php

use App\User;
use App\Token;
use App\Mail\TokenMail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\DomCrawler\Crawler;

class TokenMailTest extends FeatureTestCase
{
    function test_it_sends_a_link_with_the_token()
    {
        $user = new User([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@doe.com'
        ]);

        $token = new Token([
            'token' => 'this-is-a-token',
            'user' => $user,
        ]);

        $this->open(new TokenMail($token))
            ->seeLink($token->url, $token->url);
    }

    protected function open(Mailable $mailable)
    {
        $transport = Mail::getSwiftMailer()->getTransport();
        $transport->flush();

        Mail::send($mailable);

        $message = $transport->messages()->first();

        $this->crawler = new Crawler($message->getBody());

        return $this;
    }
}
