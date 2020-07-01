<?php

use think\facade\Route;

Route::group('', function () {
    //查询酒店列表
    Route::post(':version/saleHotelList', ':version.SaleProduct/SaleHotelList');



})->header('Access-Control-Allow-Origin:*')
    ->header('Access-Control-Allow-Headers:Origin,Content-Type,auth')
    ->header('Access-Control-Allow-Methods:GET,POST,PATCH,PUT,OPTIONS')
    ->allowCrossDomain();

