# Backblaze Laravel Adapter

Setup:

```
composer require amelia/backblaze
```

Register `Amelia\Backblaze\BackblazeServiceProvider::class`, then add a config array in `filesystems.php`.

```
'b2' => [
    'driver' => 'b2',
    'key' => env('BACKBLAZE_KEY'),
    'host' => env('BACKBLAZE_HOST'),
    'bucket' => env('BACKBLAZE_BUCKET'),
    'account' => env('BACKBLAZE_ACCOUNT'),
],
```

`host` can be set if you want to link directly to files in buckets marked `allPublic`.

See [this handy guide](https://silversuit.net/blog/2016/04/how-to-set-up-a-practically-free-cdn/) for setting up cloudflare page rules to turn your bucket into a CDN.

## Features

- Caches the auth token, meaning you don't constantly hit the auth endpoint.
- Refreshes the auth token for long-running processes (like `queue:work`).
