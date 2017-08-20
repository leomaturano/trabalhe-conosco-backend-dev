<?php

//use Illuminate\Database\Seeder;

use Jenssegers\Mongodb\Eloquent\Model;
use Flynsarmy\CsvSeeder\CsvSeeder;
use App\Picpayuser;

class PicpayusersTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $arquivoCSV = realpath( base_path().'/../csvData' ) . DIRECTORY_SEPARATOR . 'users.csv';

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
        $this->table = 'picpayusers';
       // $this->model = 'Picpayuser';
        $this->offset_rows = 0;
        $this->mapping = [
            0 => 'idpp',
            1 => 'nome',
            2 => 'username',
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
        
        // Uncomment the below to wipe the table clean before populating
        DB::table($this->table)->truncate();

        echo "Tempo estimado 3 minutos.";
        echo "\n.";
        parent::run();
    
        $regCount = Picpayuser::count();
        echo "\n.";
        if ($regCount != 8078162) {
            echo "Possível erro na importação, o arquivo original possui 8.078.162 registros.";
        }
        echo "Foram importados $regCount registros.";
        echo "\n.";
    }
}
