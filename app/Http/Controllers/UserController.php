<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\UserWasCreated;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**Hay que hacer la validación de mostrar solamente los usuarios de su rol
        o de menor prioridad**/
        return view('backoffice.user.index', [
            'users' => User::paginate(8),
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //Verificamos que el usuario tenga ese permiso asignado
        $this->authorize('create', $user);

        $user->saveUser($request);

        return redirect()->route('user.index')->with('status', '¡Usuario guardado exitosamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('backoffice.user.show', [
            'user' => $user,
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $user->updateUser($user, $request);

        return redirect()->route('user.show', $user)->with('status', '¡Usuario actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function edit_password(User $user)
    {
        return view('frontoffice.password.edit', compact('user'));
    }

    public function update_password(Request $request, User $user)
    {
        $request->validate([
            'password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (Hash::check($request['password'], $user->password)) {
            $user->update([
                'password' => Hash::make($request['new_password'])
            ]);

            return redirect()->back()->with('status', 'Contraseña actualizada exitosamente');
        } else {
            return redirect()->back()->with('cancel', 'La contraseña actual que ingresó no es correcta. Operación fallida');
        }
    }
}
