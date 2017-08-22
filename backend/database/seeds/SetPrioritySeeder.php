<?php

use Illuminate\Database\Seeder;

use Jenssegers\Mongodb\Eloquent\Model;

class SetPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        echo "\n.";
        echo date('Y-m-d H:i:s');
        echo "\n.";

        DB::collection('picpayusers')
            ->join('priority2', 'picpayusers.id', '=', 'priority2.id')
            ->update( ["priority" => 2 ] );

        echo "\n.";
        echo date('Y-m-d H:i:s');
        echo "\n.";
    
        DB::collection('picpayusers')
            ->join('priority1', 'picpayusers.id', '=', 'priority1.id')
            ->update( ["priority" => 1 ] );

        echo "\n.";
        echo date('Y-m-d H:i:s');
        echo "\n.";
        echo "\n.";        
                
    }
}
