<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Address;
use App\Policies\AddressPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }

    protected $policies = [
        Address::class => AddressPolicy::class,
    ];
} 