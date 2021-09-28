<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Blogger']);


        Permission::create(['name' => 'admin.home', 'description' => 'Ver de Dashboard'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver Listado de Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.create', 'description' => 'Agregar Usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Editar Usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.destroy', 'description' => 'Eliminar Usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.trash', 'description' => 'Ver Papelera de Usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.restore', 'description' => 'Restaurar Usuario'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.delete', 'description' => 'Destruir Usuario'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.categories.index', 'description' => 'Ver Listado de Categorias'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.categories.create', 'description' => 'Agregar Categoria'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit', 'description' => 'Editar Categoria'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy', 'description' => 'Eliminar Categoria'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.trash', 'description' => 'Ver Papelera de Categorias'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.restore', 'description' => 'Restaurar Categoria'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.delete', 'description' => 'Destruir Categoria'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.tags.index', 'description' => 'Ver Listado de'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.tags.create', 'description' => 'Agregar Etiqueta'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.edit', 'description' => 'Editar Etiqueta'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy', 'description' => 'Eliminar Etiqueta'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.trash', 'description' => 'Papelera de Etiquetas'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.restore', 'description' => 'Restaurar Etiqueta'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.delete', 'description' => 'Destruir Etiqueta'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.posts.index', 'description' => 'Ver Listado de'])->syncRoles([$role1], $role2);
        Permission::create(['name' => 'admin.posts.create', 'description' => 'Agregar Etiqueta'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit', 'description' => 'Editar Etiqueta'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy', 'description' => 'Eliminar Etiqueta'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.trash', 'description' => 'Papelera de Etiquetas'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.restore', 'description' => 'Restaurar Etiqueta'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.delete', 'description' => 'Destruir Etiqueta'])->syncRoles([$role1, $role2]);
    }
}
