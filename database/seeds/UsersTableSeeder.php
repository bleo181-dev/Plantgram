<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([ 
            'nickname'              => 'admin', 
            'email'                 => 'admin@admin.it',
            'password'              =>  Hash::make('password'),
            'foto'                  => 'lupo.jpg',
            'email_verified_at'     => '2021-12-29 10:33:43'
        ]);
    }
}
