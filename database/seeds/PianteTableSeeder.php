<?php

use Illuminate\Database\Seeder;
use App\Pianta;

class PianteTableSeeder extends Seeder
{
    /**
     * inutile, fatta solo per sport
     *
     * @return void
     */
    public function run()
    {

        Pianta::create([
            'codice_serra' => '111', 
            'nome'         => 'Basilico', 
            'foto'         => 'foto.jpg', 
            'luogo'        => 'Giardino', 
            'stato'        => '1'
        ]);
    }
} 
