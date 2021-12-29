<?php

use Illuminate\Database\Seeder;
use App\Bisogno;

class BisognoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bisogno::create([
            'codice_pianta' => '1', 
            'nome'         => 'acqua', 
            'cadenza'      => '3'
        ]);
    }
}
