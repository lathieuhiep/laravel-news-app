<?php

namespace App\Providers;

use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\CategoryPost\CategoryPostRepository;
use App\Repositories\CategoryPost\CategoryPostRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\BaseRepository;
use App\Repositories\BaseRepositoryInterfaces;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\PostRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		// base repository
	    $this->app->bind(BaseRepositoryInterfaces::class, BaseRepository::class);
		
		// eloquent repository
	    $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CategoryPostRepositoryInterface::class, CategoryPostRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
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
