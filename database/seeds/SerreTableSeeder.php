<?php

use Illuminate\Database\Seeder;
use App\Serra;

class SerreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Serra::create([
            'codice_utente' => '1', 
            'nome'          => 'Bamba', 
            'capienza'      => '15', 
            'latitudine'    => '0.0', 
            'longitudine'   => '0.0'
        ]);
    }
}
