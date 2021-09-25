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


        Permission::create(['name' => 'admin.home'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.trash'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.restore'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.categories.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.trash'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.restore'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.tags.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.destroy'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.trash'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.restore'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.tags.delete'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.posts.index'])->syncRoles([$role1], $role2);
        Permission::create(['name' => 'admin.posts.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.edit'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.destroy'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.trash'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.restore'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.posts.delete'])->syncRoles([$role1, $role2]);
    }
}
