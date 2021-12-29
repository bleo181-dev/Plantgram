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
            'nome'              => 'nascita'
        ]);
    }
}
