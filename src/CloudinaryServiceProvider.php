<?php namespace Nord\Lumen\Cloudinary;

use Enl\Flysystem\Cloudinary\ApiFacade as CloudinaryClient;
use Enl\Flysystem\Cloudinary\CloudinaryAdapter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class CloudinaryServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('cloudinary', function ($app, $config) {
            $client = new CloudinaryClient([
                'cloud_name' => $config['name'],
                'api_key'    => $config['key'],
                'api_secret' => $config['secret'],
            ]);

            return new Filesystem(new CloudinaryAdapter($client));
        });
    }


    /**
     * @inheritdoc
     */
    public function register()
    {
        //
    }
}
