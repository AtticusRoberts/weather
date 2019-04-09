<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;

class weatherController extends Controller {
  public function get(Request $request) {
    // {Authorization: '654e74a1e003a57b6b44aa3b8b6f88f0'}
    $client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://wx.wearebraid.com/',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);

    $res = $client->get('/stations'.'/'.$request['code'],['Authorization => 654e74a1e003a57b6b44aa3b8b6f88f0']);


    return $res;
  }
}
