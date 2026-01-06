<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('access-superadmin', function () {
            return User::SUPERADMIN == Auth::user()->role ? Response::allow() : Response::deny('Anda tidak berhak mengakses halaman ini.');
        });
        
Gate::define('validate-resource', function ($user, $data) {

    // Superadmin bebas
    if ($user->role == 1) {
        return Response::allow();
    }

    // Data tidak ada
    if (!$data) {
        return Response::deny('Data tidak ditemukan');
    }

    // created_by kosong
    if (empty($data->created_by)) {
        return Response::deny('Kolom created_by kosong');
    }

    // Bukan pemilik data
    if ($data->created_by !== $user->email) {
        return Response::deny('Anda tidak berhak mengakses data ini');
    }

    return Response::allow();
});

    }
}
