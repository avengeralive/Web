<?php
namespace Leadrock\Layouts;

use Leadrock\Helpers\Storage;
use Leadrock\Helpers\Url;

class PreLanding extends Landing
{
    const DAMAGED_URL = 'https://google.com';

    /**
     * Prepare webmaster URL or create one
     *
     * @return string
     */
    public function getWebmasterLink()
    {
        $url = (new Url($this))->createLinkFromPart($this->webmasterLink);
        if (empty($url)) {
            $url = self::DAMAGED_URL;
        }

        return $url;
    }

    protected function addTrackScript()
    {
        $url = (new Url($this))->createLinkFromPart($this->webmasterLink);
        $params = [
            'getUrl' => 1,
            'is_prelanding' => $this instanceof PreLanding ? 1 : 0,
            'domain' => $this->getServerUrl(),
        ];
        $url .= ((strpos($url, '?') === false) ? '?' : '&') . http_build_query($params);

        foreach ($this->getProviders() as $provider) {
            $jsCode = $provider->getJsInsertionCode($url, $this->getTrackId(), $this->getTrackUrlOnloadEventCode());
            if (!empty($jsCode)) {
                $this->addJsCode($jsCode, -1);
            }
        }
    }

    private function getTrackUrlOnloadEventCode()
    {
        return <<<JAVASCRIPT
var aElements = document.getElementsByTagName("a");
for (var i = 0; i < aElements.length; i++) {
    aElements[i].href = xhr.responseText
}
JAVASCRIPT;
    }

    /**
     * Building URL to replace links
     *
     * @return string
     */
    private function createFullUrl()
    {
        $url = $this->getWebmasterLink() . (strpos($this->getWebmasterLink(), '?') ? '&' : '?');
        return $url . http_build_query(['track_id' => Storage::restoreParam(Storage::TRACK_ID)]);
    }

    /**
     * Integration run
     *
     * @param $content
     * @return mixed
     */
    public function render($content)
    {
        Storage::saveParam(Storage::TRACK_ID, $this->getTrackId());
        $this->debugLog('Replacing links to ' . $this->createFullUrl());

        $pattern = '/<a(.+)href="([^"]+)?"/im';
        $replace = '<a$1href="' . $this->createFullUrl() . '"';

        return preg_replace($pattern, $replace, $content);
    }
}