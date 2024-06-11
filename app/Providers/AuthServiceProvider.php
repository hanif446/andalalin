<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('manage_data_permohonan',function($user){
            return $user->hasAnyPermission([
                'data_permohonan_show',
                'data_permohonan_create',
                'data_permohonan_update',
                'data_permohonan_delete'
            ]);
        });

        Gate::define('manage_data_pemohon',function($user){
            return $user->hasAnyPermission([
                'data_pemohon_show',
                'data_pemohon_detail'
            ]);
        });

        Gate::define('manage_pengajuan_permohonan',function($user){
            return $user->hasAnyPermission([
                'pengajuan_permohonan_show',
                'pengajuan_permohonan_create',
                'pengajuan_permohonan_update',
                'pengajuan_permohonan_detail',
                'pengajuan_permohonan_delete'
            ]);
        });

        Gate::define('manage_edit_profil',function($user){
            return $user->hasAnyPermission([
                'edit_profil_update'
            ]);
        });

        Gate::define('manage_users',function($user){
            return $user->hasAnyPermission([
                'user_show',
                'user_create',
                'user_update',
                'user_detail',
                'user_delete'
            ]);
        });

        Gate::define('manage_roles',function($user){
            return $user->hasAnyPermission([
                'role_show',
                'role_create',
                'role_update',
                'role_detail',
                'role_delete'
            ]);
        });
    }
}
