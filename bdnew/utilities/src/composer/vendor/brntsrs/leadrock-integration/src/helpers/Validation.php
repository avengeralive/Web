<?php
namespace Leadrock\Helpers;
use Leadrock\Layouts\Landing;

class Validation
{
    const JS_VALIDATOR_URL = 'https://cdn.ldrock.com/validator.js';
    const JS_VALIDATOR_CONFIG_URL = '{PROTOCOL}://{DOMAIN}/api/v2/validation/config';
    const JS_VALIDATOR_CLASS_NAME = 'LeadrockValidator';

    const API_DEFAILT_DOMAIN = 'leadrock.com';
    const API_DEFAULT_PROTOCOL = 'https';

    protected $apiDomain;
    protected $apiProtocol;

    public function __construct($apiProtocol = false, $apiDomain = false)
    {
        $this->apiDomain = self::API_DEFAILT_DOMAIN;
        $this->apiProtocol = self::API_DEFAULT_PROTOCOL;

        if (!empty($apiProtocol)) {
            $this->apiProtocol = $apiProtocol;
        }
        if (!empty($apiDomain)) {
            $this->apiDomain = $apiDomain;
        }
    }

    private function replaceMacros($url)
    {
        return str_replace(['{PROTOCOL}', '{DOMAIN}'], [$this->apiProtocol, $this->apiDomain], $url);
    }

    public function appendTo(Landing $landing)
    {
        $landing->addJsFile($landing->replaceUrl($this->replaceMacros(self::JS_VALIDATOR_URL . '?' . time())));
        $landing->addJsCode($this->generateConfigRequestCode($landing));
    }

    private function generateConfigRequestCode(Landing $landing)
    {
        $urlRequest = $this->replaceMacros(self::JS_VALIDATOR_CONFIG_URL);
        $trackId = $landing->getTrackId(true);
        $urlParams = [];
        if (!empty($trackId)) {
            $urlParams['track_id'] = $trackId;
        } else {
            $urlParams['track_url'] = $landing->getWebmasterLink();
        }

        $urlRequest .= (strpos($urlRequest, '?') === false ? '?' : '&') . http_build_query($urlParams);
        $urlRequest = $landing->replaceUrl($urlRequest);

        $validatorClassName = self::JS_VALIDATOR_CLASS_NAME;
        return <<<JAVASCRIPT
(function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '{$urlRequest}' + '&domain=' + window.location.protocol + '//' + window.location.host, true);
    xhr.withCredentials = true;
    xhr.cache = false;
    xhr.onload = function() {
        var data = JSON.parse(xhr.responseText);
        if (data.is_enabled) {
            {$validatorClassName}.init(data);
        }
    };
    xhr.send();
})();
JAVASCRIPT;
    }
}