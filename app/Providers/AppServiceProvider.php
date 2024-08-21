<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Policies\AddressPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
// use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
//     /**
//      * Register any application services.
//      */
//     public function register(): void
//     {
//         //
//     }

// //    protected $policies = [
// //        Address::class => AddressPolicy::class,
// //    ];

//     public function boot()
//     {

//     }

/**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Address::class => AddressPolicy::class,
        Order::class => OrderPolicy::class,
        Product::class => ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // You can also define additional Gates here if needed
    }
}
