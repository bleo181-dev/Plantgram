<?php

use Illuminate\Database\Seeder;
use App\Evento;

class EventiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evento::create([
            'codice_pianta'     => '1', 
            'codice_utente'     => '1', 
            'codice_bisogno'    => '1',
            'data'              => '2021-12-30 17:55:20',
            'nome'              => 'nascita'
        ]);
    }
}
