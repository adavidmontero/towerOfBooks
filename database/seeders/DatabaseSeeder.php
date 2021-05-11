<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /**Creamos datos falsos para los autores, géneros y categorías de acuerdo a lo
        definido en los factories */
        //También creamos un usuario con datos asignados desde aquí, es decir sin un factory

        //Author::factory(10)->create();

        //Genre::factory(10)->create();

        //Category::factory(10)->create();
        
        //Creacion de usuario
        $user = new User([
            'name' => 'Andrés Montero',
            'email' => 'correo@correo.com',
            'password' => Hash::make('123456')
        ]);

        $user->save();

        $user2 = new User([
            'name' => 'Margot Robbie',
            'email' => 'correo2@correo2.com',
            'password' => Hash::make('123456789')
        ]);

        $user2->save();

        $user3 = new User([
            'name' => 'Lily James',
            'email' => 'correo3@correo3.com',
            'password' => Hash::make('123456789')
        ]);

        $user3->save();

        //Creacion de roles
        $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Administrador']);
        $secretaryRole = Role::create(['name' => 'Secretary', 'display_name' => 'Secretario']);
        $readerRole = Role::create(['name' => 'Reader', 'display_name' => 'Lector']);

        /*Creacion de permisos*/
        //Usuarios
        $viewUsersPermission = Permission::create(['name' => 'View users', 'display_name' => 'Ver usuarios']);
        $createUsersPermission = Permission::create(['name' => 'Create users', 'display_name' => 'Crear usuarios']);
        $updateUsersPermission = Permission::create(['name' => 'Update users', 'display_name' => 'Actualizar usuarios']);
        $deleteUsersPermission = Permission::create(['name' => 'Delete users', 'display_name' => 'Eliminar usuarios']);

        //Roles
        $viewRolesPermission = Permission::create(['name' => 'View roles', 'display_name' => 'Ver roles']);
        $createRolesPermission = Permission::create(['name' => 'Create roles', 'display_name' => 'Crear roles']);
        $updateRolesPermission = Permission::create(['name' => 'Update roles', 'display_name' => 'Actualizar roles']);
        $deleteRolesPermission = Permission::create(['name' => 'Delete roles', 'display_name' => 'Eliminar roles']);
        
        //Permisos
        $viewPermission = Permission::create(['name' => 'View permissions', 'display_name' => 'Ver permisos']);
        $updatePermission = Permission::create(['name' => 'Update permissions', 'display_name' => 'Actualizar permisos']);

        $user->assignRole($adminRole);
        //$admin->assignRole($teacherRole);
        /* $adminRole->syncPermissions([
            $viewUsersPermission,
            $createUsersPermission,
            $updateUsersPermission,
            $deleteUsersPermission,
            $viewRolesPermission,
            $createRolesPermission,
            $updateRolesPermission,
            $deleteRolesPermission,
            $viewPermission,
            $updatePermission
        ]); */

        $user2->assignRole($secretaryRole);
        $user3->assignRole($readerRole);
    }
}
