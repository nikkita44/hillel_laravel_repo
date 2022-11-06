<?php

namespace App\Repositories\Tag;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(BaseRepositoryInterface::class, function ($app) {
            return new TagRepository();
        });
    }

}
