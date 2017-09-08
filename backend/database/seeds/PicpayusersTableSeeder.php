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
            echo "\n. Importando o arquivo $arquivoCSV ";
            echo "\n.";
        } else {
            echo "\n. Arquivo nao encontrado: $arquivoCSV ";
            echo "\n.";
        }
        echo "\n. " . date('Y-m-d H:i:s');

        // Aumenta para 100 linhas inseridas por vez.
        $this->insert_chunk_size = 100;        

        $this->filename = $arquivoCSV;
        $this->table = 'picpayusers';
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
        
        parent::run();

        $regCount = Picpayuser::count();
        echo "\n. Foram importados $regCount registros.";
        if ($regCount != 8078162) {
            echo "\n. Possível erro na importação, o arquivo original possui 8.078.162 registros.";
        }
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
        foreach ($seedData as $key => &$value ) {
            // Acrescenta o campo de prioridade default
            $value["priority"] = 255;
        }
        
/* eliminada a priorização junto com a tabela aumentou o tempo em 4x            
        // Altera o array incluindo a prioridade de acordo com o nivel.
            // Priorizando o nivel 2
            if ( DB::collection('priority2')->where('idpp', $value['idpp'])->count() > 0 ) {
                $value["priority"] = 2;
            } else {
                // Priorizando o nivel 1
                if ( DB::collection('priority1')->where('idpp', $value['idpp'])->count() > 0 ) {
                    $value["priority"] = 1;                    
                } else {
                    $value["priority"] = 255;
                }
            }
*/            

        // Mantem a execução padrão sobre o Array alterado.
        return parent::insert( $seedData );
	}
}
