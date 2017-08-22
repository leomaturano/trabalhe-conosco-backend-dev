<?php

//use Illuminate\Database\Seeder;

use Jenssegers\Mongodb\Eloquent\Model;
use Flynsarmy\CsvSeeder\CsvSeeder;

class Priority2TableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $arquivoCSV = realpath( base_path().'/..' ) . DIRECTORY_SEPARATOR . 'lista_relevancia_2.txt';

        if (file_exists( $arquivoCSV )) {
            echo "\n.";
            echo "Importando o arquivo $arquivoCSV";
            echo "\n...\n";
        } else {
            echo "\n.";
            echo "Arquivo nao encontrado: $arquivoCSV ";
            echo "\n.";
        }

        $this->filename = $arquivoCSV;
        $this->table = 'priority2';
        $this->offset_rows = 0;
        $this->mapping = [
            0 => 'id',
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

        // https://github.com/Flynsarmy/laravel-csv-seeder
        // Recommended when importing larger CSVs
        DB::disableQueryLog();
        
        // Uncomment the below to wipe the table clean before populating  ->default(PHP_INT_MAX)
        DB::table($this->table)->truncate();

        echo date('Y-m-d H:i:s');
        echo "\n.";
        echo "Tempo estimado ? minutos.";
        echo "\n.";
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