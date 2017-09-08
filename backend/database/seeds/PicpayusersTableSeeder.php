<?php

use Jenssegers\Mongodb\Eloquent\Model;
use App\Picpayuser;

// https://github.com/Flynsarmy/laravel-csv-seeder
use Flynsarmy\CsvSeeder\CsvSeeder;
//use Illuminate\Database\Seeder;

class PicpayusersTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $arquivoCSV = realpath( base_path().'/../csvData' ) . DIRECTORY_SEPARATOR . 'users.csv';

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
        
        // Recommended when importing larger CSVs
        DB::disableQueryLog();
        
        // Uncomment the below to wipe the table clean before populating 
        DB::table($this->table)->truncate();

        
        echo "\n. Importando PicPayUsersTable";
        parent::run();

        // Seta um valor padrao para prioridade
        // DB::collection('picpayusers')->update( ["priority" => 255] );

        // $regCount = Picpayuser::count();
        $regCount = 0;

        echo "\n.";
        if ($regCount != 8078162) {
            echo "Possível erro na importação, o arquivo original possui 8.078.162 registros.";
        }

        echo "Foram importados $regCount registros.";
        echo "\n.";
        echo date('Y-m-d H:i:s');
        echo "\n.";
        echo "\n.";
    }

    /**
     * Sobrescrevo o metodo insert para fazer a priorização antes de inserir os dados
     *
     * @param array $seedData Array com até 50 itens, cada item é uma linha a ser inserido no banco.
     * @return bool   TRUE on success else FALSE
     */
	public function insert( array $seedData )
	{
        // Altera o array incluindo a prioridade de acordo com o nivel.
        foreach ($seedData as $key => &$value ) {
            // Priorizando o nivel 2
            if ( DB::collection('priority2')->where('idpp', $value['idpp'])->count() > 0 ) {
                $value["priority"] = 2;
            } else {
                // Priorizando o nivel 1
                if ( DB::collection('priority1')->where('idpp', $value['idpp'])->count() > 0 ) {
                    $value["priority"] = 1;                    
                } else {
                    // Acrescenta o campo de prioridade default
                    $value["priority"] = 255;                  
                }
            }
        }
        echo '.';

        // Mantem a execução padrão sobre o Array alterado.
        return parent::insert( $seedData );
	}

}
