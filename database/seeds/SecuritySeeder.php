<?php

use Illuminate\Database\Seeder;
use App\Models\Local\Permission;
use App\Models\Local\Role;

class SecuritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create([
        	'name' => 'all',
        	'label' => 'Everything',
        ]);
        $role = Role::create([
        	'name' => 'super',
        	'label' => 'Superuser',
        ]);
        $role->permissions()->sync($permission);

        Permission::create([
            'name' => 'security.permissions.index',
            'label' => 'Listar Permissões',
        ]);
        Permission::create([
            'name' => 'security.permissions.show',
            'label' => 'Ver Permissão',
        ]);
        Permission::create([
            'name' => 'security.permissions.store',
            'label' => 'Criar Permissão',
        ]);
        Permission::create([
            'name' => 'security.permissions.update',
            'label' => 'Atualizar Permissão',
        ]);
        Permission::create([
            'name' => 'security.permissions.destroy',
            'label' => 'Excluir Permissão',
        ]);

        Permission::create([
            'name' => 'security.roles.index',
            'label' => 'Listar Papéis',
        ]);
        Permission::create([
            'name' => 'security.roles.show',
            'label' => 'Ver Papel',
        ]);
        Permission::create([
            'name' => 'security.roles.store',
            'label' => 'Criar Papel',
        ]);
        Permission::create([
            'name' => 'security.roles.update',
            'label' => 'Atualizar Papel',
        ]);
        Permission::create([
            'name' => 'security.roles.destroy',
            'label' => 'Excluir Papel',
        ]);
    }
}
