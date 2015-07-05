<?php namespace Nord\Lumen\Cloudinary;

use Enl\Flysystem\Cloudinary\ApiFacade;
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
        Storage::extend('cloudinary', function ($config) {
            $cloudName = array_get($config, 'cloudName', env('CLOUDINARY_NAME'));
            $apiKey    = array_get($config, 'apiKey', env('CLOUDINARY_KEY'));
            $apiSecret = array_get($config, 'apiSecret', env('CLOUDINARY_SECRET'));

            $client = new ApiFacade([
                'cloud_name' => $cloudName,
                'api_key'    => $apiKey,
                'api_secret' => $apiSecret,
            ]);

            return new Filesystem(new CloudinaryAdapter($client));
        });
    }


    /**
     * @inheritdoc
     */
    public function register()
    {

    }
}
