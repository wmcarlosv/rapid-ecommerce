<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        Schema::defaultStringLength(191);

        $events->Listen(BuildingMenu::class, function(BuildingMenu $event){
            switch(auth::user()->role){

                case 'admin':
                    $event->menu->add([
                        'text' => 'Escritorio',
                        'route' => 'home',
                        'icon' => 'fas fa-tachometer-alt' 
                    ],[
                        'text' => 'Perfil',
                        'route' => 'profile',
                        'icon' => 'fas fa-user-cog'
                    ],[
                        'text' => 'Categorias',
                        'route' => 'categories.index',
                        'icon' => 'fas fa-file'
                    ],[
                        'text' => 'Etiquetas',
                        'route' => 'tags.index',
                        'icon' => 'fas fa-tag'
                    ],[
                        'text' => 'Unidades de Medidas',
                        'route' => 'uoms.index',
                        'icon' => 'fas fa-balance-scale'
                    ],[
                        'text' => 'Productos',
                        'route' => 'products.index',
                        'icon' => 'fas fa-box'
                    ],[
                        'text' => 'Ordenes',
                        'route' => 'orders.index',
                        'icon' => 'fas fa-file-invoice'
                    ]);

                break;
            }  

        });
    }
}
