<?php

use Illuminate\Database\Seeder;
use App\Models\Local\User;
use App\Models\Local\Permission;
use App\Models\Local\Role;
use Illuminate\Support\Facades\Hash;

class SecuritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Perfil para super usuário
        $permission = Permission::create([
        	'name' => 'all',
        	'label' => 'Everything',
        ]);
        $role = Role::create([
        	'name' => 'super',
        	'label' => 'Superuser',
        ]);
        $role->permissions()->sync($permission);

        // Perfil Admin
        $adminRole = Role::create([
            'name' => 'admin',
            'label' => 'Administrador do sistema',
        ]);

        $permissionsPermission = Permission::create([
            'name' => 'security.permissions.index',
            'label' => 'Listar Permissões',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($permissionsPermission);
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

        $rolesPermission = Permission::create([
            'name' => 'security.roles.index',
            'label' => 'Listar Perfis',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($rolesPermission);
        $rolesPermission = Permission::create([
            'name' => 'security.roles.show',
            'label' => 'Ver Perfil',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($rolesPermission);

        $rolesPermission = Permission::create([
            'name' => 'security.roles.store',
            'label' => 'Criar Perfil',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($rolesPermission);
        $rolesPermission = Permission::create([
            'name' => 'security.roles.update',
            'label' => 'Atualizar Perfil',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($rolesPermission);
        $rolesPermission = Permission::create([
            'name' => 'security.roles.destroy',
            'label' => 'Excluir Perfil',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($rolesPermission);
        
        //
        // Perfil Cliente e permissões para o perfil
        //

        $clienteRole = Role::create([
            'name' => 'cliente',
            'label' => 'Clientes',
        ]);

        $clienteRolePermissions = Permission::create([
        	'name' => 'user.register',
        	'label' => 'Cadastro de usuário',
            ]);
        $clienteRole->permissions()->syncWithoutDetaching($clienteRolePermissions);
        $clienteRolePermissions = Permission::create([
        	'name' => 'user.edit.yourself',
        	'label' => 'Ver e editar dados próprios',
        ]);
        $clienteRole->permissions()->syncWithoutDetaching($clienteRolePermissions);
        $adminRole->permissions()->syncWithoutDetaching($clienteRolePermissions);
        $clienteRolePermissions = Permission::create([
        	'name' => 'user.update.yourself',
        	'label' => 'Atualizar dados próprios',
        ]);
        $clienteRole->permissions()->syncWithoutDetaching($clienteRolePermissions);
        $adminRole->permissions()->syncWithoutDetaching($clienteRolePermissions);

        $adminRolePermissions = Permission::create([
        	'name' => 'security.users.index',
        	'label' => 'Exibir lista de usuários',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'security.users.store',
        	'label' => 'Incluir novos usuários',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'security.users.show',
        	'label' => 'Dados de um usuário específico',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'security.users.update',
        	'label' => 'Atualizar dados de um usuário específico',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'security.users.destroy',
        	'label' => 'Excluir um usuário específico',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($adminRolePermissions);
        $adminRolePermissions = Permission::create([
        	'name' => 'admin.logviewer',
        	'label' => 'Ver log de acessos ao sistema',
        ]);
        $adminRole->permissions()->syncWithoutDetaching($adminRolePermissions);

        //
        // Inclusão do super usuário para inciar o sistema
        //
        $user = User::create([
            'name' => 'Administrador',
            'email' => 'desafio@seventh.com.br',
            'password' => Hash::make('12345678'),
        ]);

        $user->roles()->sync($adminRole);
    }
}
