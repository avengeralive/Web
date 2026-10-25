<?php
namespace Leadrock\Providers;

use GuzzleHttp\Client;
use Leadrock\Helpers\Cookie;
use Leadrock\Helpers\Storage;
use Leadrock\Layouts\Proxy;

class Leadrock extends Provider
{
    private $apiKey;
    private $apiSecret;
    /**
     * @var Client
     */
    private $transport;
    private $apiUrlDomain;
    private $apiUrlProtocol;
    private $trackingUrl;

    const API_URL = '{PROTOCOL}://{DOMAIN}/api/v2/';
    const API_DEFAULT_DOMAIN = 'leadrock.com';
    const API_DEFAULT_PROTOCOL = 'https';

    public function __construct($apiKey, $apiSecret, $domain = false)
    {
        $this->apiUrlProtocol = self::API_DEFAULT_PROTOCOL;
        $this->apiUrlDomain = self::API_DEFAULT_DOMAIN;

        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;

        if (!empty($domain)) {
            $this->apiUrlDomain = str_replace(['http://', 'https://'], '', $domain);
            if (strpos($domain, 'http://') !== false) {
                $this->apiUrlProtocol = 'http';
            }
        }

        $this->createTransport();
    }

    /**
     * @return string
     */
    public function getApiDomain()
    {
        return $this->apiUrlDomain;
    }

    /**
     * @return string
     */
    public function getApiProtocol()
    {
        return $this->apiUrlProtocol;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @return mixed
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * Send data to lead storage
     *
     * @param $endpoint
     * @param $data
     * @return string
     */
    protected function write($endpoint, $data)
    {
        $response = $this->getTransport()->post(
            $this->createUrl($endpoint, 'save'),
            ['form_params' => $this->sign($data)]
        );

        return (string)$response->getBody();
    }

    /**
     * Lead request from storage by provided ID
     *
     * @param $endpoint
     * @param $id
     * @return array
     */
    protected function readById($endpoint, $id)
    {
        $response = $this->getTransport()->post(
            $this->createUrl($endpoint, 'view'),
            ['body' => $this->sign([
                'id' => $id,
            ])]
        );

        $result = json_decode($response->getBody(), true);
        if (isset($result['lead'])) {
            return $result['lead'];
        }
        return [];
    }

    /**
     * Lead request from storage by provided ID
     *
     * @param $endpoint
     * @param integer $limit
     * @param integer $offset
     * @return array
     */
    protected function readAll($endpoint, $limit = 10, $offset = 0)
    {
        $response = $this->getTransport()->post(
            $this->createUrl($endpoint, 'list'),
            ['body' => $this->sign([
                'limit' => $limit,
                'offset' => $offset,
            ])]
        );

        $result = json_decode($response->getBody(), true);
        if (isset($result['leads'])) {
            return $result['leads'];
        }
        return [];
    }

    /**
     * Request transport getter
     *
     * @return Client
     */
    private function getTransport()
    {
        if (empty($this->transport)) {
            $this->createTransport();
        }

        return $this->transport;
    }

    /**
     * Request transport create and set default params
     */
    private function createTransport()
    {
        $urlParts = parse_url($this->createUrl('', ''));

        $this->transport = new Client([
            'base_uri'    => (isset($urlParts['scheme']) ? $urlParts['scheme'] : 'http') . '://' . $urlParts['host'],
            'timeout'     => 30,
            'http_errors' => false,
            'verify' => false,
            'allow_redirects' => true,
            'headers'         => [
                'User-Agent' => 'API Integration | Client ID-' . $this->apiKey . ' | ' . (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'console'),
            ],
        ]);
    }

    /**
     * Full server API url create
     *
     * @param $endpoint
     * @param $action
     * @return string
     */
    private function createUrl($endpoint, $action)
    {
        return str_replace(['{PROTOCOL}', '{DOMAIN}'], [$this->apiUrlProtocol, $this->apiUrlDomain], self::API_URL) . $endpoint . '/' . $action;
    }

    /**
     * Sign request params
     *
     * @param $params
     * @return mixed
     */
    private function sign($params)
    {
        $params['api_key'] = $this->apiKey;
        ksort($params);

        $params['sign'] = sha1(http_build_query($params) . $this->apiSecret);

        return $params;
    }

    public function close()
    {
        //do nothing
    }

    protected function prepareDataToSave($data, $userIp, $userAgent)
    {
        if (empty($data['track_id'])) {
            if (!empty($this->trackingUrl)) {
                $params = [
                    'ip' => $userIp,
                    'ua' => $userAgent,
                ];

                $url = $this->trackingUrl . (strpos($this->trackingUrl, '?') === false ? '?' : '&') . http_build_query($params);
                $response = $this->getTransport()->get($url);
                $responseData = (string)$response->getBody();
                if (!empty($responseData)) {
                    @$responseData = json_decode($responseData, true);
                    if (isset($responseData['track_id'])) {
                        $data['track_id'] = $responseData['track_id'];
                    }
                }
            }
        }

        return $data;
    }

    public function getJsInsertionCode($trackingUrl, $trackId, $onloadEvent = '')
    {
        $this->trackingUrl = $trackingUrl;

        $trackingUrl = Proxy::convertUrl($trackingUrl);
        return <<<JAVASCRIPT
(function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '{$trackingUrl}', true);
    xhr.withCredentials = true;
    xhr.cache = false;
    xhr.onload = function() {
        {$onloadEvent}
    };
    xhr.send();
})();
JAVASCRIPT;
    }
}