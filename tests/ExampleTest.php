<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->assertTrue(false);

        $user = factory(\App\User::class)->create([
            'name' => 'John Doe',
            'email' => 'john@doe.com'
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see('John Doe')
            ->see('john@doe.com');
    }
}
