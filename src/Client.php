<?php

namespace Amelia\Backblaze;

use Illuminate\Support\Facades\Cache;
use ChrisWhite\B2\Client as BaseClient;

class Client extends BaseClient
{
    /**
     * {@inheritdoc}
     */
    protected function authorizeAccount()
    {
        $response = $this->auth();

        $this->authToken = $response['authorizationToken'];
        $this->apiUrl = $response['apiUrl'] . '/b2api/v1';
        $this->downloadUrl = $response['downloadUrl'];
    }

    /**
     * Get the latest authorization token.
     *
     * @return string
     */
    protected function token()
    {
        $request = $this->auth();

        return $request['authorizationToken'];
    }

    /**
     * Get an authorization token back from b2.
     *
     * @return array
     */
    protected function auth()
    {
        return Cache::remember('b2', 1320, function () {
            $this->client->request('GET', 'https://api.backblaze.com/b2api/v1/b2_authorize_account', [
                'auth' => [$this->accountId, $this->applicationKey]
            ]);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function createBucket(array $options)
    {
        $this->authToken = $this->token();

        return parent::createBucket($options);
    }

    /**
     * {@inheritdoc}
     */
    public function updateBucket(array $options)
    {
        $this->authToken = $this->token();

        return parent::updateBucket($options);
    }

    /**
     * {@inheritdoc}
     */
    public function listBuckets()
    {
        $this->authToken = $this->token();

        return parent::listBuckets();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteBucket(array $options)
    {
        $this->authToken = $this->token();

        return parent::deleteBucket($options);
    }

    /**
     * {@inheritdoc}
     */
    public function upload(array $options)
    {
        $this->authToken = $this->token();

        return parent::upload($options);
    }

    /**
     * {@inheritdoc}
     */
    public function download(array $options)
    {
        $this->authToken = $this->token();

        return parent::download($options);
    }

    /**
     * {@inheritdoc}
     */
    public function listFiles(array $options)
    {
        $this->authToken = $this->token();

        return parent::listFiles($options);
    }

    /**
     * {@inheritdoc}
     */
    public function getFile(array $options)
    {
        $this->authToken = $this->token();

        return parent::getFile($options);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteFile(array $options)
    {
        $this->authToken = $this->token();

        return parent::deleteFile($options);
    }
}
