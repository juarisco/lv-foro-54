<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class)->create([
            'first_name' => 'Josef',
            'last_name' => 'Waelchi',
            'username' => 'Juarisco',
            'email' => 'josef@mail.com',
            'role' => 'admin'
        ]);
    }
}
