<?php

use Illuminate\Database\Seeder;
use App\Models\Local\Permission;
use App\Models\Local\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Perfil Cliente e permissões para o perfil
        $clienteRole = Role::create([
            'name' => 'cliente',
            'label' => 'Clientes',
        ]);

        $clienteRolePermissions = Permission::create([
        	'name' => 'user.register',
        	'label' => 'Cadastro de usuário',
            ]);
        $clienteRole->permissions()->sync($clienteRolePermissions);
        $clienteRolePermissions = Permission::create([
        	'name' => 'user.edit.yourself',
        	'label' => 'Ver e editar dados próprios',
        ]);
        $clienteRole->permissions()->sync($clienteRolePermissions);
        $clienteRolePermissions = Permission::create([
        	'name' => 'user.update.yourself',
        	'label' => 'Atualizar dados próprios',
        ]);
        $clienteRole->permissions()->sync($clienteRolePermissions);

        // Perfil Admin e permissões para o perfil
        $adminRole = Role::create([
            'name' => 'admin',
            'label' => 'Administrador do sistema',
        ]);

        $adminRolePermissions = Permission::create([
        	'name' => 'admin.user.list',
        	'label' => 'Exibir lista de usuários',
        ]);
        $adminRole->permissions()->sync($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'admin.user.create',
        	'label' => 'Tela de criação de novos usuários',
        ]);
        $adminRole->permissions()->sync($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'admin.user.store',
        	'label' => 'Incluir novos usuários',
        ]);
        $adminRole->permissions()->sync($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'admin.user.edit',
        	'label' => 'Tela de edição de usuários',
        ]);
        $adminRole->permissions()->sync($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'admin.user.update',
        	'label' => 'Atualizar dados de qualquer usuário',
        ]);
        $adminRole->permissions()->sync($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'admin.user.delete',
        	'label' => 'Excluir qualquer usuário',
        ]);
        $adminRole->permissions()->sync($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'admin.logviewer',
        	'label' => 'Ver log de acessos ao sistema',
        ]);
        $adminRole->permissions()->sync($adminRolePermissions);
    }
}
