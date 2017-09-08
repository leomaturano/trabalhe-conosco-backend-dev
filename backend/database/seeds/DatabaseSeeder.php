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
        echo "\n. Tempo estimado 10 minutos. Referencia Core I3, 8Gb";
        echo "\n. **** Inicio = ";
        echo date('Y-m-d H:i:s');
        echo "\n.";

        $this->call(Priority1TableSeeder::class);
        $this->call(Priority2TableSeeder::class);

        $this->call(PicpayusersTableSeeder::class);

        // $this->call(SetPrioritySeeder::class);

        echo "\n. **** Final = ";
        echo date('Y-m-d H:i:s');
        echo "\n.";
        
    }
}
