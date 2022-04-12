<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;
use App\Repositories\ContactUsRepository;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\GroupRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            UserRepositoryInterface::class, 
            UserRepository::class,
            ProductRepositoryInterface::class, 
            ProductRepository::class,
            AdminRepositoryInterface::class, 
            AdminRepository::class,
            OrderRepositoryInterface::class, 
            PreOrderRepository::class,
            BookNowRepository::class,
            ContactUsRepositoryInterface::class, 
            ContactUsRepository::class,
            FeedbackClubRepositoryInterface::class, 
            FeedbackClubRepository::class,
            NotifyMeRepositoryInterface::class, 
            NotifyMeRepository::class,
            FacebookCSVLeadRepositoryInterface::class, 
            FacebookCSVLeadRepository::class,
            BaseRepositoryInterface::class, 
            BaseRepository::class,
            GroupRepositoryInterface::class, 
            GroupRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
