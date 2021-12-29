<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SerreTableSeeder::class);
        $this->call(PianteTableSeeder::class);
        $this->call(BisognoTableSeeder::class);
        $this->call(EventiTableSeeder::class);
        $this->call(DiarioTableSeeder::class);
    }
}
