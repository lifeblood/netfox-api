<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function test() {
        $res        = DB::table('AccountsInfo')->select('*')->where('UserID','=','1')->first();
        print_r($res);
    }
    //
}
