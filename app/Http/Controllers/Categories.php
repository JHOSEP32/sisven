<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use App\Category;

class Categories extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index')->with(['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'nombre' => 'required|unique:categories,name'
        ]);

        $category = new Category();
        $category->name = $request->nombre;
        if ($category->save()) {
            return redirect()->action('Categories@index')->with(['msj' => 'Categoría añadida con éxito.']);
        } else {
            return redirect()->action('Categories@index')->with(['errorMsj' => 'Error al guardar los datos.']);
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
        $category = Category::find($id);
        return view('categories.view')->with(['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if ($category != null) {
            return view('categories.edit')->with(['category' => $category]);
        } else {
            return redirect()->action('Categories@index')->with(['errorMsj' => 'La categoría no existe.']);
        }
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
            'nombre' => 'required|unique:categories,name'
        ]);

        $category = Category::find($id);
        $category->name = $request->nombre;
        if ($category->save()) {
            return redirect()->action('Categories@index')->with(['msj' => 'Categoría editada con éxito.']);
        } else {
            return redirect()->action('Categories@index')->with(['errorMsj' => 'Error al guardar los datos.']);
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
        Category::destroy($id);
        return redirect()->action('Categories@index')->with(['msj' => 'Categoría eliminada con éxito.']);
    }
}
