<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Products extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::select('SELECT p.*, c.id AS cid, c.name AS cname, pv.id AS pvid, pv.name AS pvname FROM products p INNER JOIN categories c ON (p.cat_id = c.id) INNER JOIN providers pv ON (p.prov_id = pv.id) ORDER BY p.name ASC');
        return view('products.index')->with(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $providers = Provider::all();
        return view('products.create')->with([
            'categories' => $categories,
            'providers' => $providers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'categoria' => 'required',
            'proveedor' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
        ]);
        $product = new Product();
        $product->name = $request->nombre;
        $product->cat_id = $request->categoria;
        $product->prov_id = $request->proveedor;
        $product->description = $request->descripcion;
        $product->price = $request->precio;
        $product->stock = 0;
        if ($product->save()) {
            return redirect()->action('Products@index')->with(['msj' => 'Producto añadido con éxito.']);
        } else {
            return redirect()->action('Products@index')->with(['errorMsj' => 'Error al guardar los datos.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::select('SELECT p.*, c.id AS cid, c.name AS cname, pv.id AS pvid, pv.name AS pvname FROM products p INNER JOIN categories c ON (p.cat_id = c.id) INNER JOIN providers pv ON (p.prov_id = pv.id) WHERE p.id = ? LIMIT 1', [$id]);
        return view('products.view')->with(['product' => $product[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = DB::select('SELECT p.*, c.id AS cid, c.name AS cname, pv.id AS pvid, pv.name AS pvname FROM products p INNER JOIN categories c ON (p.cat_id = c.id) INNER JOIN providers pv ON (p.prov_id = pv.id) WHERE p.id = ? LIMIT 1', [$id]);
        $categories = Category::all();
        $providers = Provider::all();
        return view('products.edit')->with([
            'product' => $product[0],
            'categories' => $categories,
            'providers' => $providers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'categoria' => 'required',
            'proveedor' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
        ]);
        $product = Product::find($id);
        $product->name = $request->nombre;
        $product->cat_id = $request->categoria;
        $product->prov_id = $request->proveedor;
        $product->description = $request->descripcion;
        $product->price = $request->precio;
        if ($product->save()) {
            return redirect()->action('Products@index')->with(['msj' => 'Producto editado con éxito.']);
        } else {
            return redirect()->action('Products@index')->with(['errorMsj' => 'Error al guardar los datos.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->action('Products@index')->with(['msj' => 'Producto eliminado con éxito.']);
    }

}
