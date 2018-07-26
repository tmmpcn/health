<?php

namespace App\Http\Controllers;

class SwaggerController extends Controller
{
    public function create()
    {
        $swagger = \Swagger\scan('/Users/yangmao/wwwroot/wx.6530.cn/app/Http');
        header('Content-Type: application/json');
        echo $swagger;

    }

}