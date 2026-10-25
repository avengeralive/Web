<?php
namespace Leadrock\Items;

use Leadrock\Helpers\Storage;

class FacebookPixel
{
    private $id = null;
    private $event = 'PageView';
    private $price = null;
    private $currency = null;
    private $advancedMatchingParams = [];

    public function __construct($id = null, $advancedMatchingParams = [])
    {
        $this->id = $id;
        $this->setAdvancedMatchingParams();
    }

    private function setAdvancedMatchingParams()
    {
        $params = [];
        foreach ($_GET as $param => $value) {
            if (strpos($param, 'fb_') !== false) {
                $params[str_replace('fb_', '', $param)] = $value;
            }
        }
        $this->advancedMatchingParams = $params;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Search ID from request param
     *
     * @param $param
     * @return $this
     */
    public function findFrom($param)
    {
        if (isset($_REQUEST[$param])) {
            $this->id = $_REQUEST[$param];
            Storage::saveParam(Storage::FB_PIXEL_ID, $this->id);
        } else {
            $this->id = Storage::restoreParam(Storage::FB_PIXEL_ID);
        }

        return $this;
    }

    /**
     * Setting event name
     *
     * @param $name
     * @return $this
     */
    public function setEvent($name)
    {
        $this->event = $name;

        return $this;
    }

    /**
     * Setting event price
     *
     * @param $price
     * @param $currency
     * @return $this
     */
    public function setPrice($price, $currency)
    {
        $this->price = floatval($price);
        $this->currency = $currency;

        return $this;
    }

    /**
     * Generating html code
     *
     * @return string
     */
    public function getImageCode()
    {
        if (empty($this->id)) {
            return false;
        }
        $params = [
            'id' => $this->id,
            'ev' => $this->event,
            'noscript' => 1,
        ];
        if (!empty($this->price) && !empty($this->currency)) {
            $params['cd'] = [
                'value' => $this->price,
                'currency' => $this->currency,
            ];
        }
        if (!empty($this->advancedMatchingParams)) {
            $params['ud'] = $this->advancedMatchingParams;
        }

        $url = 'https://www.facebook.com/tr?' . str_replace(['%5B', '%5D'], ['[', ']'], http_build_query($params));
        return '<img src="' . $url . '" />';
    }

    public function getJsCode()
    {
        if (empty($this->id)) {
            return false;
        }
        $advancedMatchingParams = empty($this->advancedMatchingParams) ? null : (', ' . json_encode($this->advancedMatchingParams));
        return 'fbq(\'init\', \'' . $this->id . '\'' . $advancedMatchingParams . ');';
    }

    public function getJsCodeEvent()
    {
        if (empty($this->id)) {
            return false;
        }
        $code = [];
        if ($this->event != 'PageView') {
            $code[] = 'fbq(\'track\', \'PageView\');';
        }
        $code[] = 'fbq(\'track\', \'' . $this->event . '\');';
        return implode("\r\n", $code);
    }

    public static function getFullJsCode($fbInits, $fbImgs, $fbEvent)
    {
        return <<<HTMLCODE
<!-- Facebook Pixel Code -->
<script>
 !function(f,b,e,v,n,t,s)
 {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
 n.callMethod.apply(n,arguments):n.queue.push(arguments)};
 if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
 n.queue=[];t=b.createElement(e);t.async=!0;
 t.src=v;s=b.getElementsByTagName(e)[0];
 s.parentNode.insertBefore(t,s)}(window, document,'script',
 'https://connect.facebook.net/en_US/fbevents.js');
 {$fbInits}
 {$fbEvent}
</script>
<noscript>{$fbImgs}</noscript>
<!-- End Facebook Pixel Code -->
HTMLCODE;
    }

    public static function getFullJsCodeSignature()
    {
        return 'function(f,b,e,v,n,t,s)';
    }
}