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
    public function test()
    {
        $data = DB::table('stocks')->where('id',1)->get()->toArray();
        var_dump($data);
    }
    public  function test1()
    {

    }
}
