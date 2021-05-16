<?php

namespace App\Models;

use App\Events\UserWasCreated;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** RELACIONES */

    // 1 usuario tiene un perfil
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // 1 usuario tiene muchos prestamos
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /** ALMACENAMIENTO */

    public function saveUser($request)
    {
        //Validamos los datos
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roles' => ['required']
        ]);

        //Asignamos a cada atributo los valores validados
        $user = new user([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        //Guardamos el usuario
        $user->save();

        //Asignamos roles al usuario
        $user->assignRole($request->roles);

        //Asignamos todos los permisos al usuario
        $user->givePermissionTo($request['permissions']);

        //Crear perfil si el usuario tiene el rol reader
        if ($user->hasRole('Reader')) {
            UserWasCreated::dispatch($user['id']);
        }
    }

    public function updateUser($user, $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id]
        ]);

        //Asignamos a cada atributo los valores validados
        $user->update($request->all());

        //Asignamos roles al usuario
        $user->syncRoles($request->roles);

        //Asignamos todos los permisos al usuario
        $user->syncPermissions($request->permissions);
    }

    /* public static function totalReader(User $user)
    {
        return $user->whereHas('roles', function($q) {
            $q->where('name', 'Reader');
        })->count();
    } */
}
