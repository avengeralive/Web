<?php
namespace Leadrock\Layouts;

use Leadrock\Helpers\Client;
use Psr\Http\Message\ResponseInterface;

class Proxy
{
    private $url;

    private static $isTurnedOff = false;

    public static function disable()
    {
        self::$isTurnedOff = true;
    }

    public static function enable()
    {
        self::$isTurnedOff = false;
    }

    public static function isDisabled()
    {
        return self::$isTurnedOff;
    }

    public function __construct($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $url = base64_decode($url);
        }
        $this->url = $url;
    }

    private function cacheHeaders()
    {
        return [
            "Expires: Mon, 26 Jul 1997 05:00:00 GMT",
            "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT",
            "Cache-Control: no-store, no-cache, must-revalidate",
            "Cache-Control: post-check=0, pre-check=0"
        ];
    }

    private function blockedHeaders()
    {
        return [
            'cf-ray',
            'expect-ct',
            'server',
            'cf-ipcountry',
            'cf-visitor',
            'cf-connecting-ip',
            'transfer-encoding',
        ];
    }

    /**
     * @return \Proxy\Http\Request
     */
    private function getParsedRequest()
    {
        static $parsedRequest;

        if (empty($parsedRequest)) {
            $parsedRequest = \Proxy\Http\Request::createFromGlobals();
        }
        return $parsedRequest;
    }

    private function parseRequestHeaders()
    {
        $parsedRequest = $this->getParsedRequest();
        $headers = [];
        foreach ($parsedRequest->headers->all() as $name => $value) {
            $name = implode('-', array_map('ucfirst', explode('-', $name)));
            $headers[$name] = $value;
        }

        foreach ($headers as $param => $value) {
            if (in_array(strtolower($param), $this->blockedHeaders())) {
                unset($headers[$param]);
            }
        }

        return $headers;
    }

    public function forwardContent()
    {
        $headers = $this->parseRequestHeaders();

        $urlParts = parse_url($this->url);
        $headers['Host'] = $urlParts['host'];


        $request = new \GuzzleHttp\Psr7\Request(
            $this->getParsedRequest()->getMethod(),
            $this->url,
            $headers,
            $this->getParsedRequest()->getRawBody()
        );

        $client = new \GuzzleHttp\Client([
            'base_uri'    => (isset($urlParts['scheme']) ? $urlParts['scheme'] : 'http') . '://' . $urlParts['host'],
            'timeout'     => 30,
            'http_errors' => false,
            'verify' => false,
            'allow_redirects' => false,
        ]);
        $response = $client->send($request);

        $this->sendHeadersFromResponse($response);
        return (string)$response->getBody();
    }

    private function sendHeadersFromResponse(ResponseInterface $response)
    {
        $headers = [];
        foreach($response->getHeaders() as $name => $values){
            if (!in_array(strtolower($name), $this->blockedHeaders())) {
                // could be an array if multiple headers are sent with the same name?
                foreach ((array)$values as $value) {
                    $name = implode('-', array_map('ucfirst', explode('-', $name)));
                    $headers[] = (sprintf("%s: %s", $name, $value));
                }
            }
        }

        foreach ($headers as $header) {
            list($param, $value) = explode(': ', $header);
            if (!in_array(strtolower($param), $this->blockedHeaders())) {
                header($header);
            }
        }

        foreach ($this->cacheHeaders() as $header) {
            header($header);
        }
        http_response_code($response->getStatusCode());
    }

    public static function convertUrl($url)
    {
        if (self::$isTurnedOff) {
            return $url;
        }
        $url .= (strpos($url, '?') === false ? '?' : '&') .
            'ip=' . Client::getIp() .
            '&ua=' . Client::getUserAgent();

        return '?forward=' . base64_encode($url);
    }
}