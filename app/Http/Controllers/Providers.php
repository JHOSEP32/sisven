<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;

class Providers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return view('providers.index')->with(['providers' => $providers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('providers.create');
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
            'descripcion' => 'required',
            'email' => 'email'
        ]);
        $provider = new Provider();
        $provider->name = $request->nombre;
        $provider->description = $request->descripcion;
        $provider->telephone = $request->telefono;
        $provider->cellphone = $request->celular;
        $provider->email = $request->email;
        $provider->address = $request->direccion;
        if ($provider->save()) {
            return redirect()->action('Providers@index')->with(['msj' => 'Proveedor añadido con éxito.']);
        } else {
            return redirect()->action('Providers@index')->with(['errorMsj' => 'Error al guardar los datos.']);
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
        $provider = Provider::find($id);
        return view('providers.view')->with(['provider' => $provider]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provider = Provider::find($id);
        return view('providers.edit')->with(['provider' => $provider]);
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
            'descripcion' => 'required',
            'email' => 'email'
        ]);
        $provider = Provider::find($id);
        $provider->name = $request->nombre;
        $provider->description = $request->descripcion;
        $provider->telephone = $request->telefono;
        $provider->cellphone = $request->celular;
        $provider->email = $request->email;
        $provider->address = $request->direccion;
        if ($provider->save()) {
            return redirect()->action('Providers@index')->with(['msj' => 'Proveedor editado con éxito.']);
        } else {
            return redirect()->action('Providers@index')->with(['errorMsj' => 'Error al guardar los datos.']);
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
        Provider::destroy($id);
        return redirect()->action('Providers@index')->with(['msj' => 'Proveedor eliminado con éxito.']);
    }
}
