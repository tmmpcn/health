<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public $apiResponse = ['code'=>0,'message'=>'','data'=>[]];
}
