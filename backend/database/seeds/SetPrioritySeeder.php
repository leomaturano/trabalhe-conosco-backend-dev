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

        /* Join não funcionou com MongoDB
            DB::collection('picpayusers')
                ->join('priority2', 'picpayusers.idpp', '=', 'priority2.idp')
                ->update( ["priority" => 2 ] );

            DB::collection('picpayusers')
                ->join('priority1', 'picpayusers.idpp', '=', 'priority1.idpp')
                ->update( ["priority" => 1 ] );
        */

        echo "\n. Priorizando o nivel 2";
        echo "\n. " . date('Y-m-d H:i:s');
        echo "\n.";
        
        $this->priorizar( DB::collection('priority2')->get(), 2);

        echo "\n. Priorizando o nivel 1";
        echo "\n. " . date('Y-m-d H:i:s');        
        echo "\n.";

        $this->priorizar( DB::collection('priority1')->get(), 1);
    }

    private function priorizar($arrId, $nivel)
    {
        foreach ($arrId as $key => $value) {
            DB::collection('picpayusers')
            ->where('idpp', $value['idpp'])
            ->update( ["priority" => $nivel] );
        }
    }
}
