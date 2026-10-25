<?php
namespace Leadrock\Layouts;

use Leadrock\Helpers\Cookie;
use Leadrock\Helpers\Storage;
use Leadrock\Helpers\Url;
use Leadrock\Helpers\Validation;
use Leadrock\Items\Lead;
use Leadrock\Providers\Provider;

class Landing extends Layout
{
    const RESTORE_PARAM_NAME = 'restore';
    const RESTORE_TIME_FROM_NAME = 'timeFrom';
    const RESTORE_TIME_TO_NAME = 'timeTo';

    protected $trackParamName = 'track_id';
    protected $urlParamName = 'track_url';
    protected $webmasterLink = false;
    protected $isUseFormValidator = false;

    private $thankyouUrl;
    private $fields = [
        'user_phone' => 'phone',
        'user_name' => 'name',
        'other' => 'other',
    ];

    /**
     * @var Provider[]
     */
    private $leadSaveProviders = [];

    /**
     * Setting track param name to value search
     *
     * @param $trackParam
     * @return $this
     */
    public function findTrackIn($trackParam)
    {
        $this->trackParamName = $trackParam;
        $this->debugLog('Set track param name = ' . $trackParam);

        return $this;
    }

    /**
     * Link form data to lead params
     *
     * @param $paramName
     * @param $fieldName
     * @return $this
     */
    public function setFormField($paramName, $fieldName)
    {
        $this->fields[$paramName] = $fieldName;
        $this->debugLog('Set form field name ' . $paramName . ' = ' . $fieldName);

        return $this;
    }

    /**
     * Link form data to lead params
     *
     * @param array $params
     * @return $this
     */
    public function setFormFields($params)
    {
        foreach ($params as $paramName => $fieldName) {
            $this->setFormField($paramName, $fieldName);
        }

        return $this;
    }

    /**
     * @param Provider $provider
     * @return $this
     */
    public function addProvider(Provider $provider)
    {
        $this->leadSaveProviders[$provider::getClassName()] = $provider;
        $this->debugLog('Added lead provider: ' . var_export($provider, true));

        return $this;
    }

    /**
     * @return Provider[]
     */
    public function getProviders()
    {
        return $this->leadSaveProviders;
    }

    public function beforeRender()
    {
        if (isset($_REQUEST[$this->urlParamName])) {
            if ($this->getMethod() != 'POST') {
                Storage::clearAll();
            }
            $this->setWebmasterLink((new Url($this))->createLinkFromPart(urldecode($_REQUEST[$this->urlParamName])));
        }

        if ($this->getTrackId(true) === null) {
            $this->debugLog('Need to add tracking script');
            $this->addTrackScript();
        } else {
            $this->debugLog('TrackId exists, no need in tracking script');
        }

        $this->appendFormValidator();

        if ($this->getMethod() == 'POST') {
            $this->createLead();
            if (!empty($this->thankyouUrl)) {
                $this->redirect($this->thankyouUrl);
            }
        } elseif (isset($_REQUEST[self::RESTORE_PARAM_NAME]) && isset($_REQUEST[self::RESTORE_TIME_FROM_NAME]) && isset($_REQUEST[self::RESTORE_TIME_TO_NAME])) {
            $this->restoreLeads($_REQUEST[self::RESTORE_TIME_FROM_NAME], $_REQUEST[self::RESTORE_TIME_TO_NAME]);
            return false;
        }

        return parent::beforeRender();
    }

    /**
     * Parsing form POST data and send it to providers
     */
    private function createLead()
    {
        $this->debugLog('Creating new lead');

        $this->storeTrackInCookies();
        $lead = new Lead(Storage::restoreParam(Storage::TRACK_ID));
        $lead->setReferrer((new Url($this))->fullUrl());
        $lead->setBrowserParams($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
        $this->debugLog('Lead data: ' . json_encode($lead->getFullData()));

        foreach ($this->leadSaveProviders as $provider) {
            $this->debugLog('Adding provider to lead: ' . get_class($provider));
            $lead->addProvider($provider);
        }

        foreach ($this->fields as $param => $field) {
            $lead->setParam($param, isset($_REQUEST[$field]) ? $_REQUEST[$field] : '');
        }
        $this->parseProviderResponse($lead->save());

        $this->addFacebookPixelToThankYouUrl(empty($response['facebook_id']) ? null : $response['facebook_id']);
        $this->addPersonalDataToThankYouUrl('ph', $lead->getParam('user_phone'));
        $this->addPersonalDataToThankYouUrl('fn', $lead->getParam('user_name'));
    }

    /**
     * Applying response settings to user further actions
     *
     * @param $response
     */
    private function parseProviderResponse($response)
    {
        $this->debugLog('Lead save response: ' . json_encode($response));

        if (!empty($response['facebook_id'])) {
            Storage::saveParam(Storage::FB_PIXEL_ID, $response['facebook_id']);
        }
        if (!empty($response['thankyou_url'])) {
            $this->thankyouUrl = $response['thankyou_url'];
        }
    }

    /**
     * Replacing macros in url
     *
     * @param $pixelId
     */
    private function addFacebookPixelToThankYouUrl($pixelId)
    {
        if (!empty($pixelId)) {
            if (strpos($this->thankyouUrl, '{fbpixel}') !== false) {
                $this->thankyouUrl = str_replace('{fbpixel}', $pixelId, $this->thankyouUrl);
            } else {
                $this->thankyouUrl .= (strpos($this->thankyouUrl, '?') === false ? '?' : '&') . 'fbpixel=' . $pixelId;
            }
        }
    }

    private function addPersonalDataToThankYouUrl($param, $value)
    {
        if (!empty($value)) {
            $this->thankyouUrl .= (strpos($this->thankyouUrl, '?') === false ? '?' : '&') . 'fb_' . $param . '=' . hash('sha256', $value);
        }
    }

    public function render($content)
    {
        $pattern = '/<form(.+)action="([^"]+)"/';
        $replace = '<form$1action=""';

        return preg_replace($pattern, $replace, $content);
    }

    /**
     * Getting track ID from request
     * @param $doNotUseStorage
     *
     * @return null
     */
    public function getTrackId($doNotUseStorage = false)
    {
        if (isset($_REQUEST[$this->trackParamName])) {
            if ($this->getMethod() != 'POST') {
                Storage::clearAll();
            }
            return $_REQUEST[$this->trackParamName];
        } elseif (empty($doNotUseStorage) && Storage::restoreParam(Storage::TRACK_ID)) {
            return Storage::restoreParam(Storage::TRACK_ID);
        }
        return null;
    }

    /**
     * Save track ID in cookies to restore in thank-you page
     */
    protected function storeTrackInCookies()
    {
        Storage::saveParam(Storage::TRACK_ID, $this->getTrackId());
        $this->debugLog('Saved cookies: ' . Storage::TRACK_ID . ' = ' . $this->getTrackId());

        return $this;
    }

    /**
     * Reading URL param to set extra click
     *
     * @param $param
     * @return $this
     */
    public function setWebmasterLinkFromParam($param)
    {
        $this->urlParamName = $param;

        return $this;
    }

    /**
     * Adding extra js ajax click to create track ID
     * Will add one more js click to landing to store track ID in cookies
     *
     * @param $url
     * @return $this
     */
    public function setWebmasterLink($url)
    {
        $this->webmasterLink = (new Url($this))->convertAndFixWebmasterLink($url);

        return $this;
    }

    public function getWebmasterLink()
    {
        return $this->webmasterLink;
    }

    public function setThankyouPage($url)
    {
        $this->thankyouUrl = $url;
        return $this;
    }

    protected function addTrackScript()
    {
        if (!empty($this->webmasterLink)) {
            $params = [
                'ajax' => 1,
                'json' => 1,
                'is_prelanding' => $this instanceof PreLanding ? 1 : 0,
                'domain' => $this->getServerUrl(),
            ];
            $trackId = $this->getTrackId(true);
            if (!empty($trackId)) {
                $this->debugLog('TrackId exists');

                $this->storeTrackInCookies();
                $params[$this->trackParamName] = $trackId;
            } else {
                $this->debugLog('TrackId requests');
            }

            $url = (new Url($this))->createLinkFromPart($this->webmasterLink);
            $url .= ((strpos($url, '?') === false) ? '?' : '&') . http_build_query($params);


            foreach ($this->getProviders() as $provider) {
                $jsCode = $provider->getJsInsertionCode($url, $trackId, $this->getTrackUrlOnloadEventCode());
                if (!empty($jsCode)) {
                    $this->addJsCode($jsCode, -1);
                }
            }
        } else {
            $this->debugLog('No webmaster link, can not add tracking script');
        }
    }

    private function getTrackUrlOnloadEventCode()
    {
        $cookieTrakIdParam = Cookie::getPrefix() . Storage::TRACK_ID;

        return <<<JAVASCRIPT
var response = JSON.parse(xhr.responseText);

if (response.track_id.length > 0) {
    days = 30;
    var date = new Date();
    date.setTime(date.getTime() + (days*24*60*60*1000));
    expires = "; expires=" + date.toUTCString();
    
    document.cookie = "{$cookieTrakIdParam}=" + response.track_id + "; domain=." + window.location.hostname + "; path=/" + expires;
}

if (response.fbpixel.length > 0) {
    fbq('init', response.fbpixel);
    fbq('track', 'PageView');
}
JAVASCRIPT;
    }

    public function afterRender()
    {
        $this->closeProviders();
        return parent::afterRender();
    }

    private function closeProviders()
    {
        foreach ($this->leadSaveProviders as $provider) {
            $provider->close();
        }
    }

    /**
     * @param $timeFrom
     * @param $timeTo
     */
    protected function restoreLeads($timeFrom, $timeTo)
    {
        if (isset($this->leadSaveProviders[\Leadrock\Providers\File::getClassName()])) {
            $providerFrom = $this->leadSaveProviders[\Leadrock\Providers\File::getClassName()];
        } else {
            return;
        }
        if (isset($this->leadSaveProviders[\Leadrock\Providers\Leadrock::getClassName()])) {
            $providerTo = $this->leadSaveProviders[\Leadrock\Providers\Leadrock::getClassName()];
        } else {
            return;
        }

        $result = $providerTo->restoreFromOtherProvider($providerFrom, $timeFrom, $timeTo);

        echo json_encode([
            'status' => is_array($result) && count($result) > 0 ? 'ask more' : 'stop, please',
            'data' => $result,
        ]);
    }

    /**
     * Adding validation scripts to form
     *
     * @return $this
     */
    public function addFormValidator()
    {
        $this->isUseFormValidator = true;

        return $this;
    }

    protected function appendFormValidator()
    {
        if ($this->isUseFormValidator) {
            if (isset($this->leadSaveProviders[\Leadrock\Providers\Leadrock::getClassName()])) {
                $apiProtocol = $this->leadSaveProviders[\Leadrock\Providers\Leadrock::getClassName()]->getApiProtocol();
                $apiDomain = $this->leadSaveProviders[\Leadrock\Providers\Leadrock::getClassName()]->getApiDomain();
                (new Validation($apiProtocol, $apiDomain))->appendTo($this);
            } else {
                (new Validation())->appendTo($this);
            }
        }
    }
}