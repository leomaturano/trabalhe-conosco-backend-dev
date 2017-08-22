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
        $page = (int) Input::get('page', '0');

        $result = Picpayuser::where('nome','like','%'.$search.'%')
                    ->orWhere('username','like','%'.$search.'%')
                    ->skip( ($page - 1) * 15 + 1)
                    ->take(15)
                    ->get();

                    //$users = User::orderBy('name', 'desc')->get();
                    
        return response()->json($result);
    }
}