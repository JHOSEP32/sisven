<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class Clients extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index')->with(['clients' => $clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
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
            'apellidos' => 'required',
        ]);
        $client = new Client();
        $client->dni = $request->identificacion;
        $client->name = $request->nombre;
        $client->lastname = $request->apellidos;
        $client->address = $request->direccion;
        $client->phone = $request->celular;
        if ($client->save()) {
            return redirect()->action('Clients@index')->with(['msj' => 'Cliente añadido con éxito.']);
        } else {
            return redirect()->action('Clients@index')->with(['errorMsj' => 'Error al guardar los datos.']);
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
        $client = Client::find($id);
        return view('clients.view')->with(['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('clients.edit')->with(['client' => $client]);
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
            'apellidos' => 'required',
        ]);
        $client = Client::find($id);
        $client->dni = $request->identificacion;
        $client->name = $request->nombre;
        $client->lastname = $request->apellidos;
        $client->address = $request->direccion;
        $client->phone = $request->celular;
        if ($client->save()) {
            return redirect()->action('Clients@index')->with(['msj' => 'Cliente editado con éxito.']);
        } else {
            return redirect()->action('Clients@index')->with(['errorMsj' => 'Error al guardar los datos.']);
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
        Client::destroy($id);
        return redirect()->action('Clients@index')->with(['msj' => 'Cliente eliminado con éxito.']);
    }
}
