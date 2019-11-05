<?php

class ExampleTest extends FeatureTestCase
{
    function test_basic_example()
    {
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
