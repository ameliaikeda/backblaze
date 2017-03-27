<?php

namespace Amelia\Backblaze;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class BackblazeServiceProvider extends ServiceProvider
{
    /**
     * Boot this service provider.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('b2', function ($app, $config) {
            $client = new Client($config['account'], $config['key']);

            $adapter = new Adapter($client, $config['bucket'], $config['host']);

            return new Filesystem($adapter);
        });
    }
}
