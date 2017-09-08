<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Picpayuser;

class BuscaController extends Controller
{
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
        $search = Input::get('search');
        $page = (int) Input::get('page', '1');
        $page = ($page - 1) < 0 ? 0 : $page - 1;

        $thisPage = $page + 1;
        $sizePage = (int) Input::get('sizepage', '15');
        $totalRows =  Picpayuser::where('nome', 'like', '%'.$search.'%')->orWhere('username', 'like', '%'.$search.'%')->count();
        $resto = $totalRows % 15;
        if ($resto > 0) {
            $totalPages = intdiv( $totalRows, 15 )+1;
        } else {
            $totalPages = intdiv( $totalRows, 15 );
        }

        $result = Picpayuser::where('nome', 'like', '%'.$search.'%')
                    ->orWhere('username', 'like', '%'.$search.'%')
                    ->orderBy('priority')
                    ->orderBy('idpp')
                    ->skip( $page * 15 )
                    ->take(15)
                    ->get();

        $retorno = [ 
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
