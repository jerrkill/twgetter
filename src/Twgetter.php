<?php

namespace Jerrkill\Twgetter;

use GuzzleHttp\Client;
use Jerrkill\Twgetter\Exceptions\HttpException;
use Jerrkill\Twgetter\Traits\ListTrait;
use Jerrkill\Twgetter\Traits\SearchTrait;
use Jerrkill\Twgetter\Traits\UserTrait;

class Twgetter
{
    use ListTrait;
    use SearchTrait;
    use UserTrait;

    protected $baseUri = 'https://twitter.com/i/api/';
    protected $guzzleOptions = [];

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function get(string $path, array $params, string $format = 'array')
    {
        $url = $this->baseUri . $path;

        try {
            $response = $this->getHttpClient()->get($url, [
                'query' => $params,
                'headers' => [
                    'x-csrf-token' => $this->getXCsrfToken(),
                    'cookie' => $this->getCookie(),
                    'Authorization' => $this->getAuthorization(),
                ]
            ])->getBody()->getContents();

            return 'json' === $format ? \json_decode($response, true) : $response;
        } catch (\Exception $e) {
           throw new HttpException($e->getMessage(), $e->getCode(), $e);
       }
    }

    public function getAuthorization()
    {
        return 'Bearer '.$this->getBearerToken();
    }

    public function getBearerToken()
    {
        return config('twgetter.bearer_token');
    }

    public function getXCsrfToken()
    {
        return config('twgetter.x_csrf_token');
    }

    public function getCookie()
    {
        return config('twgetter.cookie');
    }
}