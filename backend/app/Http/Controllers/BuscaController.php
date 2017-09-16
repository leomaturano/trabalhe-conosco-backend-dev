<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

//use Jenssegers\Mongodb\Eloquent\Model;
use App\Picpayuser;

use MongoDB\BSON\Regex as mongoRegex;
use MongoDB\Driver\Query as mongoQuery;;
use MongoDB\Driver\Command as mongoCommand;
   
class BuscaController extends Controller
{
    const DB_NAME  = 'picpaydb';
    const COLLECTION = 'picpayusers';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inicioPesquisa = time();

        $search = Input::get('search');

        $page = (int) Input::get('page', '1');
        $page = ($page - 1) < 0 ? 0 : $page - 1;

        $sizePage = (int) Input::get('sizepage', '15');

/*                
        // Pesquisa usando diretamente o MongoDB Driver (/api/busca?search=diether), demora 23 segundos
        //https://github.com/mongodb/mongo-php-driver/issues/195#issuecomment-169405194
        //https://github.com/mongodb/mongo-php-driver/issues/214
        //https://stackoverflow.com/questions/13578455/query-or-mongodb-in-php
        //https://github.com/jenssegers/laravel-mongodb/issues/1227
        $regex = new mongoRegex('.*' .$search. '.*', 'i');

        $filter = [
            '$or' => [['nome' => $regex], ['username' => $regex]]
        ];

        $options = [
            'projection' => [ 'idpp' => 1, 'nome' => 1, 'username' => 1 ],
            'sort' => [ 'priority' => 1,'idpp' => 1 ],
            'skip' => $page * $sizePage,
            'limit' => $sizePage
        ];

        $manager = \DB::getMongoDB()->getManager();

        $query = new mongoQuery($filter, $options);    
        $result = $manager->executeQuery(self::DB_NAME .".". self::COLLECTION, $query )->toArray();
        
        $cmd = new mongoCommand( ['count' => self::COLLECTION, 'query' => $filter ] );
        $totalRows = $manager->executeCommand( self::DB_NAME, $cmd )->toArray()[0]->n;
*/

        // Pesquisa usando Laravel MongoDB (/api/busca?search=diether), demora 22 segundos
        // https://github.com/jenssegers/laravel-mongodb
        $totalRows =  Picpayuser::where('nome', 'like', '%'.$search.'%')->orWhere('username', 'like', '%'.$search.'%')->count();
        $result = Picpayuser::where('nome', 'like', '%'.$search.'%')
                    ->orWhere('username', 'like', '%'.$search.'%')
                    ->orderBy('priority')
                    ->orderBy('idpp')
                    ->skip( $page * $sizePage )
                    ->take(15)
                    ->get();


        $thisPage = $page + 1;                    
        $resto = $totalRows % 15;
        if ($resto > 0) {
            $totalPages = intdiv( $totalRows, 15 )+1;
        } else {
            $totalPages = intdiv( $totalRows, 15 );
        }
        $finalPesquisa = time();

        $demora = $finalPesquisa - $inicioPesquisa;

        $retorno = [ 
            "demora" => $demora . ' segundos',
            "data" => $result,
            "paging" => [
                "thispage" => $thisPage,
                "sizepage" => $sizePage,
                "totalpages" => $totalPages,
                "totalrows" => $totalRows
            ]
        ];

        return response()->json($retorno);
    }
}
/*
 db.picpayusers.find({$or:[{nome:{$regex:".*maria.*"}}, {username:{$regex:".*maria.*"}}]}).sort({priority: 1, idpp:1}).skip(0).limit(15).pretty()

  paging: {
                thispage: 13,
                sizepage: 15,
                totalpages: 20,
                totalrows: 22,
            },

*/
