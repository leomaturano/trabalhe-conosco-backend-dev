<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(PicpayusersTableSeeder::class);
        $this->call(Priority1TableSeeder::class);
        $this->call(Priority2TableSeeder::class);
        $this->call(SetPrioritySeeder::class);
        
    }
}
