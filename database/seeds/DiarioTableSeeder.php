<?php

use Illuminate\Database\Seeder;
use App\Diario;

class DiarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Diario::create([
            'codice_pianta'     => '1', 
            'codice_utente'     => '1', 
            'foto'              => '',
            'testo'             => 'nascita della pianta'
        ]);   
    }
}
