<?php

namespace App\Http\Controllers;

use App\Client;
use App\Product;
use App\Sale;
use App\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AjaxData extends Controller
{

    //Sale

    public function getClient(Request $request)
    {
        if ($request->isMethod('POST')) {
            $client = Client::find($request->id);
            return Response()->json($client);
        } else {
            return redirect()->isForbidden();
        }

    }

    public function getProduct(Request $request)
    {
        if ($request->isMethod('POST')) {
            $product = Product::find($request->id);
            return Response()->json($product);
        } else {
            return redirect()->isForbidden();
        }

    }

    public function createSale(Request $request)
    {
        if ($request->isMethod('POST')) {
            $sale = new Sale();
            $sale->user = Auth::user()->id;
            $sale->datetime = date('Y-m-d h:i:s');
            $sale->total = 0;
            $sale->state = 'En proceso';
            if ($sale->save()) {
                return Response()->json($sale->id);
            } else {
                return 'fail';
            }
        } else {
            return redirect()->isForbidden();
        }
    }

    public function addProduct(Request $request)
    {
        if ($request->isMethod('POST')) {
            $product = Product::find($request->id);
            $sale_detail = new SaleDetail();
            //Calc
            $subtotal = $request->cant * $product->price;
            $res = ($request->desc / 100) * $subtotal;
            $total = $subtotal - $res;
            //--
            $sale_detail->sale = $request->sale_id;
            $sale_detail->product = $product->id;
            $sale_detail->quantity = $request->cant;
            $sale_detail->discount = $request->desc;
            $sale_detail->subtotal = $total;
            if ($sale_detail->save()) {
                self::updateSaleTotal($request->sale_id);
                return Response()->json('success');
            } else {
                return Response()->json('fail');
            }
        } else {
            return redirect()->isForbidden();
        }
    }

    public function updateSaleClient(Request $request)
    {
        if ($request->isMethod('POST')) {
            $sale = Sale::find($request->sale_id);
            $sale->client = $request->client_id;
            if ($sale->save()) {
                return Response()->json('success');
            } else {
                return Response()->json('fail');
            }
        } else {
            return redirect()->isForbidden();
        }

    }

    public function getSaleDetails(Request $request)
    {
        if ($request->isMethod('POST')) {
            $sale_datails = DB::select('SELECT s.*, p.name, p.price FROM sale_details s INNER JOIN products p ON (s.product = p.id) WHERE s.sale = ? ORDER BY s.created_at DESC', [$request->sale_id]);
            return Response()->json($sale_datails);
        } else {
            return redirect()->isForbidden();
        }
    }

    public function deleteSaleDetail(Request $request)
    {
        if ($request->isMethod('POST')) {
            SaleDetail::destroy($request->id);
            return Response()->json('success');
        } else {
            return redirect()->isForbidden();
        }
    }

    public function deleteAllDetails(Request $request)
    {
        if ($request->isMethod('POST')) {
            $sale_details = DB::select('SELECT * FROM sale_details s WHERE s.sale = ?', [$request->sale_id]);
            foreach ($sale_details as $detail) {
                SaleDetail::destroy($detail->id);
            }
        } else {
            return redirect()->isForbidden();
        }
    }

    //Static functions

    private static function updateSaleTotal($sale_id)
    {
        $sale = Sale::find($sale_id);
        $sale_details = DB::select('SELECT * FROM sale_details s WHERE s.sale = ?', [$sale_id]);
        $total = 0;
        foreach ($sale_details as $detail) {
            $total += $detail->subtotal;
        }
        $sale->total = $total;
        $sale->save();
    }

}
