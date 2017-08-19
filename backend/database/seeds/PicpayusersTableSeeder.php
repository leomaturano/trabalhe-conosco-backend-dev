<?php

//use Illuminate\Database\Seeder;

use Jenssegers\Mongodb\Eloquent\Model;
use Flynsarmy\CsvSeeder\CsvSeeder;

class PicpayusersTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'picpayusers';
        $this->model = 'Picpayuser';

        $this->filename = base_path().'/picpay-data/users.csv';
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
        
        parent::run();
    }
}
