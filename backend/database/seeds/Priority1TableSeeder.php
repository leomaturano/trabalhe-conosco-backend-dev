<?php

use Jenssegers\Mongodb\Eloquent\Model;

// https://github.com/Flynsarmy/laravel-csv-seeder
use Flynsarmy\CsvSeeder\CsvSeeder;
//use Illuminate\Database\Seeder;

class Priority1TableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $arquivoCSV = realpath( base_path().'/..' ) . DIRECTORY_SEPARATOR . 'lista_relevancia_1.txt';

        if (file_exists( $arquivoCSV )) {
            echo "\n.";
            echo "Importando o arquivo $arquivoCSV";
            echo "\n.";
        } else {
            echo "\n.";
            echo "Arquivo nao encontrado: $arquivoCSV ";
            echo "\n.";
        }
        echo date('Y-m-d H:i:s');
        echo "\n.";

        $this->filename = $arquivoCSV;
        $this->table = 'priority1';
        $this->offset_rows = 0;
        $this->mapping = [
            0 => 'idpp',
        ];
    }
    

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Este comando "desabilita" a proteção do método fill($data = []); nos models
        Model::unguard();

        // Recommended when importing larger CSVs
        DB::disableQueryLog();
        
        // Uncomment the below to wipe the table clean before populating  ->default(PHP_INT_MAX)
        DB::table($this->table)->truncate();

        echo "\n. Importando Prioridades Nivel 1";
        parent::run();

        $regCount = DB::table($this->table)->count();
        echo "\n.";
        echo "Foram importados $regCount registros.";
        echo "\n.";
        echo date('Y-m-d H:i:s');
        echo "\n.";
        echo "\n.";
    }

}
