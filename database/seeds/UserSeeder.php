<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'first_name' => 'Audric',
            'last_name' => 'Doncfack',
            'email' => 'audricdoncfack@gmail.com',
            'password' => bcrypt('audric')
        ]);
    }
}
