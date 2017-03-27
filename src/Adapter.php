<?php

namespace Amelia\Backblaze;

use BadMethodCallException;
use ChrisWhite\B2\Client;
use Mhetreramesh\Flysystem\BackblazeAdapter as BaseAdapter;

class Adapter extends BaseAdapter
{
    /**
     * The custom domain in use for backblaze, if set.
     *
     * @var string
     */
    protected $host;

    /**
     * BackblazeAdapter constructor.
     *
     * @param \ChrisWhite\B2\Client $client
     * @param string $bucketName
     * @param string $host
     */
    public function __construct(Client $client, $bucketName, $host = null)
    {
        $this->host = $host;

        parent::__construct($client, $bucketName);
    }

    /**
     * Get the URL to the given path.
     *
     * @param $path
     * @return string
     */
    public function getUrl($path)
    {
        if (! $this->host) {
            throw new BadMethodCallException("The 'host' key must be set in the b2 storage adapter to fetch URLs.");
        }

        return 'https://' . $this->host . '/file/' . $this->bucketName . '/' . $path;
    }
}
