<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'identificacion' => 'required|unique:users,dni',
            'nombre' => 'required',
            'apellidos' => 'required',
            'celular' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'contrasena' => 'required|confirmed',
            'contrasena_confirmation' => 'required',
            'estado' => 'required',
        ]);

        $user = new User();
        $user->dni = $request->identificacion;
        $user->name = $request->nombre;
        $user->lastname = $request->apellidos;
        $user->phone = $request->celular;
        $user->email = $request->email;

        //Hash
        $user->password = Hash::make($request->contrasena);

        $user->state = $request->estado;
        /* Foto section */
        if ($request->file('imagen')) {
            $img = $request->file('imagen');
            $imgRoute = time() . '_' . $img->getClientOriginalName();
            Storage::disk('userImgs')->put($imgRoute, file_get_contents($img->getRealPath()));
            $imgRoute = '/userImgs/' . $imgRoute;
        } else {
            //No foto
            $imgRoute = '/userImgs/user_profile.png';
        }
        /*----*/
        $user->img_url = $imgRoute;
        if ($user->save()) {
            return redirect()->action('Users@index')->with(['msj' => 'Usuario añadido con éxito.']);
        } else {
            return redirect()->action('USers@index')->with(['errorMsj' => 'Error al guardar los datos.']);
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
        $user = User::find($id);
        return view('users.view')->with(['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with(['user' => $user]);
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
            'identificacion' => [
                'required',
                Rule::unique('users', 'dni')->ignore($id),
            ],
            'nombre' => 'required',
            'apellidos' => 'required',
            'celular' => 'required|numeric',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'estado' => 'required',
        ]);

        $user = User::find($id);
        $user->dni = $request->identificacion;
        $user->name = $request->nombre;
        $user->lastname = $request->apellidos;
        $user->phone = $request->celular;
        $user->email = $request->email;
        $user->state = $request->estado;
        if ($user->save()) {
            return redirect()->action('Users@index')->with(['msj' => 'Usuario editado con éxito.']);
        } else {
            return redirect()->action('Users@index')->with(['errorMsj' => 'Error al guardar los datos.']);
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
        User::destroy($id);
        return redirect()->action('Users@index')->with(['msj' => 'Usuario eliminado con éxito.']);
    }

    //Custom Functions

    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('users.profile')->with(['user' => $user]);
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'apellidos' => 'required',
            'celular' => 'required'
        ]);
        $user = User::find($id);
        $user->name = $request->nombre;
        $user->lastname = $request->apellidos;
        $user->phone = $request->celular;
        if ($user->save()) {
            return redirect()->action('Users@profile')->with(['msj' => 'Perfil actualizado con éxito.']);
        } else {
            return redirect()->action('Users@profile')->with(['errorMsj' => 'Error al guardar los datos.']);
        }
    }

    public function updateProfilePhoto(Request $request, $id)
    {
        if ($request->file('imagen')) {
            $img = $request->file('imagen');
            $imgRoute = time() . '_' . $img->getClientOriginalName();
            Storage::disk('userImgs')->put($imgRoute, file_get_contents($img->getRealPath()));
            $user = User::find($id);
            Storage::disk('userImgs')->delete($user->img_url);
            $imgRoute = '/userImgs/' . $imgRoute;
            $user->img_url = $imgRoute;
            if ($user->save()) {
                return redirect()->action('Users@profile')->with(['msj' => 'Foto actualizada con éxito.']);
            } else {
                return redirect()->action('Users@profile')->with(['errorMsj' => 'Error al guardar los datos.']);
            }
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'contrasena' => 'confirmed',
        ]);
        $user = User::find($id);
        $oldPassword = $user->password;
        if (Hash::check($request->contrasena_actual, $oldPassword)) {
            $newPassword = Hash::make($request->contrasena);
            $user->password = $newPassword;
            if ($user->save()) {
                return redirect()->action('Users@profile')->with(['msj' => 'Contraseña actualizada con éxito.']);
            } else {
                return redirect()->action('Users@profile')->with(['errorMsj' => 'Error al guardar los datos.']);
            }
        } else {
            return redirect()->action('Users@profile')->with(['errorMsj' => 'La contraseña ingresada no coincide con la actual.']);
        }
    }

    //Test Functions

    public function testSql()
    {
        $users = DB::select('SELECT * FROM users u WHERE u.lastname = ?', ['ortiz']);
        foreach ($users as $user) {
            echo $user->dni . '<br>';
        }
    }
}
