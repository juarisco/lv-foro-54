<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LogoutTest extends DuskTestCase
{
    use DatabaseMigrations;

    function test_a_user_can_logout()
    {
        $user = $this->defaultUser([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/')
                ->clickLink('John Doe')
                ->clickLink('Cerrar sesión')
                ->assertGuest();
        });
    }
}
