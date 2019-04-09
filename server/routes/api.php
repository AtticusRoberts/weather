<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');
use Illuminate\Http\Request;

Route::post('/getWeather','weatherController@get');
