<?php

namespace App\Http\Controllers;

class SwaggerController extends Controller
{
    public function create()
    {

        $swagger = \Swagger\scan(str_replace("/Controllers","",dirname(__FILE__)));
        header('Content-Type: application/json');
        echo $swagger;

    }

}