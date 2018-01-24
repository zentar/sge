<?php

namespace App\Providers;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        /*
        ORDEN DE LOS ROLES 
        1 - ADMINISTRADOR
        2 - GESTOR ADMINISTRATIVO
        3 - GESTOR PRODUCCION
        4 - EDITOR
        */ 
        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {          
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });


        // Auth gates for: Libros INDEX
         Gate::define('libro_access', function ($user) {          
                return in_array($user->role_id, [1,2,3,4]);
           });
           Gate::define('libro_create', function ($user) {
               return in_array($user->role_id, [1,2]);
           });
           Gate::define('libro_edit', function ($user) {
               return in_array($user->role_id, [1,2,3,4]);
           });
           Gate::define('libro_view', function ($user) {
               return in_array($user->role_id, [1,2,3,4]);
           });
           Gate::define('libro_delete', function ($user) {
               return in_array($user->role_id, [1,2]);
           });


       // Auth gates for: Libros EDIT
       Gate::define('libro_edit_informacion', function ($user) {          
            return in_array($user->role_id, [1,2,3,4]);
       });

       Gate::define('libro_edit_informacion_accion', function ($user) {          
        return in_array($user->role_id, [1,2]);
       });

       Gate::define('libro_edit_documentos', function ($user) {
           return in_array($user->role_id, [1,2]);
       });
       Gate::define('libro_edit_edicion', function ($user) {
        return in_array($user->role_id, [1,2,3,4]);
       });
       Gate::define('libro_edit_caracteristicas', function ($user) {
           return in_array($user->role_id, [1,2,3,4]);
       });
       Gate::define('libro_edit_caracteristicas_accion', function ($user) {
        return in_array($user->role_id, [1,4]);
       });
       Gate::define('libro_edit_cotizaciones', function ($user) {
           return in_array($user->role_id, [1,2,3]);
       });

       Gate::define('libro_edit_cotizaciones_accion', function ($user) {
        return in_array($user->role_id, [1,3]);
    });
       Gate::define('libro_edit_historico', function ($user) {
           return in_array($user->role_id, [1]);
       });   

       Gate::define('libro_edit_asignaciones', function ($user) {
        return in_array($user->role_id, [1]);
    }); 
        
        // Auth gates for: Autores
        Gate::define('autor_access', function ($user) {          
             return in_array($user->role_id, [1,2]);
        });
        Gate::define('autor_create', function ($user) {
            return in_array($user->role_id, [1,2]);
        });
        Gate::define('autor_edit', function ($user) {
            return in_array($user->role_id, [1,2]);
        });
        Gate::define('autor_view', function ($user) {
            return in_array($user->role_id, [1,2]);
        });
        Gate::define('autor_delete', function ($user) {
            return in_array($user->role_id, [1,2]);
        });

        // Auth gates for: Reportes
        Gate::define('reportes_access', function ($user) {          
            return in_array($user->role_id, [1]);
       });
       Gate::define('reportes_create_general', function ($user) {          
            return in_array($user->role_id, [1]);
       });
       Gate::define('reportes_create_especifico', function ($user) {          
            return in_array($user->role_id, [1]);
       });

    }
}
