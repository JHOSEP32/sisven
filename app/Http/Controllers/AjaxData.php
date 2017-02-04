<?php

namespace App\Http\Controllers;

use App\Client;
use App\Product;
use Illuminate\Http\Request;

class AjaxData extends Controller
{

    public function getClient($id)
    {
        $client = Client::find($id);
        return Response()->json($client);
    }

    public function getProduct(Request $request)
    {
        //return dd($request);
        $product = Product::find($request->id);
        return Response()->json($product);
    }

    public function addSale(Request $request)
    {
        if ($request->isMethod('POST')) {

        }
    }

}
