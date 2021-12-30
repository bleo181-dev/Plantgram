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
            'nome'                  => 'filippo', 
            'cognome'               => 'piediscalzi', 
            'nickname'              => 'pippo', 
            'email'                 => 'pippo@pippo.it',
            'password'              =>  Hash::make('password'),
            'foto'                  => 'lupo.jpg',
            'email_verified_at'     => '2021-12-29 10:33:43'
        ]);
    }
}
