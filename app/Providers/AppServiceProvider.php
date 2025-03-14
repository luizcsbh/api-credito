<?php

namespace App\Providers;

use App\Repositories\{
    ClienteRepositoryInterface, ClienteInstituicaoRepositoryInterface,
    ClienteModalidadeRepositoryInterface,
    InstituicaoRepositoryInterface, ModalidadeRepositoryInterface
};
use App\Repositories\Eloquent\{
    ClienteRepository, ClienteInstituicaoRepository,
    ClienteModalidadeRepository,
    InstituicaoRepository, ModalidadeRepository
};
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClienteRepositoryInterface::class, ClienteRepository::class);
        $this->app->bind(ClienteInstituicaoRepositoryInterface::class, ClienteInstituicaoRepository::class);
        $this->app->bind(ClienteModalidadeRepositoryInterface::class, ClienteModalidadeRepository::class);
        $this->app->bind(InstituicaoRepositoryInterface::class, InstituicaoRepository::class);
        $this->app->bind(ModalidadeRepositoryInterface::class, ModalidadeRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
