<?php
namespace Leadrock\Layouts;

use Leadrock\Helpers\Logger;
use Leadrock\Items\FacebookPixel;
use Leadrock\Providers\File;
use Leadrock\Providers\Provider;

abstract class Layout
{
    private $assets = [
        'css' => [],
        'js' => [],
        'meta' => [],
        'js_code' => [],
    ];
    private $isRenderDisabled = false;
    private $isAssetsDisabled = false;
    /**
     * @var FacebookPixel[]
     */
    private $facebookPixels = [];
    /**
     * @var Provider
     */
    private $debugSaveProvider = false;

    /**
     * @var bool
     */
    private $isUseProxy = true;

    public function __construct()
    {
        ob_start();
        ob_implicit_flush(false);

        $this->debugLog('Layout start');
    }

    /**
     * Enable debug log file
     *
     * @param $path
     * @return $this
     */
    public function saveDebugTo($path)
    {
        $this->debugSaveProvider = new File($path);
        return $this;
    }

    /**
     * Add debug text to logger provider
     *
     * @param $text
     */
    protected function debugLog($text)
    {
        if (!empty($this->debugSaveProvider)) {
            $this->debugSaveProvider->log($text);
        }
    }

    /**
     * End of layout, integration actions start
     */
    public function end()
    {
        $content = ob_get_clean();
        $this->debugLog('Layout end');

        $this->debugLog('Runner end: ' . get_class($this));

        if ($this->beforeRender()) {
            $content = $this->addHeaderToContent($content);
            $content = $this->addFooterToContent($content);

            if (!$this->isRenderDisabled) {
                echo $this->render($content);
                $this->debugLog('Content rendered');
            } else {
                $this->debugLog('Render disabled');
            }
            $this->afterRender();
        }
    }

    /**
     * @param string $content
     * @return string
     */
    private function addHeaderToContent($content)
    {
        $header = $this->generateHeader($content);
        if ($header !== '') {
            $count = 0;
            $output = preg_replace('/(<title\b[^>]*>|<\\/head\s*>)/is', '<###head###>$1', $content, 1, $count);
            if ($count) {
                $content = str_replace('<###head###>', $header, $output);
            } else {
                $content = $header . $output;
            }
            $this->debugLog('Header added');
        }
        return $content;
    }

    /**
     * @param string $content
     * @return string
     */
    private function addFooterToContent($content)
    {
        $footer = $this->generateFooter($content);
        if ($footer !== '') {
            $content = str_replace('</body>', $footer . "\r\n" . '</body>', $content);
            $this->debugLog('Footer added');
        }
        return $content;
    }

    /**
     * Content modifiration
     *
     * @param $content
     * @return mixed
     */
    public function render($content)
    {
        return $content;
    }

    /**
     * Disabling automatic assets including to layout
     *
     * @param bool $isDisabled
     * @return $this
     */
    public function noAssets($isDisabled = true)
    {
        $this->isAssetsDisabled = $isDisabled;

        return $this;
    }

    /**
     * Disabling page render, only code handler
     *
     * @return $this
     */
    public function noRender()
    {
        $this->isRenderDisabled = true;

        return $this;
    }

    /**
     * Adding Facebook pixel to show on page
     *
     * @param FacebookPixel $pixel
     * @return $this
     */
    public function addFacebookPixel(FacebookPixel $pixel)
    {
        foreach ($this->facebookPixels as $attachedFacebookPixel) {
            if (!empty($pixel->getId()) && $pixel->getId() == $attachedFacebookPixel->getId()) {
                return $this;
            }
        }
        $this->facebookPixels[] = $pixel;

        return $this;
    }

    /**
     * Add traffic logger script, disabled by default
     *
     * @return $this
     */
    public function enableTrafficLogger()
    {
        (new Logger())->appendTo($this);

        return $this;
    }

    /**
     * Full assets header generation
     *
     * @return string
     */
    private function generateHeader($content)
    {
        if (!$this->isAssetsDisabled) {
            $assetsHtml = [];
            foreach ($this->assets['css'] as $cssFile) {
                $assetsHtml[] = '<link rel="stylesheet" type="text/css" href="' . $cssFile . '">';
                $this->debugLog('Assets: ' . $cssFile);
            }
            foreach ($this->assets['js'] as $jsFile) {
                $assetsHtml[] = '<script src="' . $jsFile . '"></script>';
                $this->debugLog('Assets: ' . $jsFile);
            }

            return implode("\r\n", $assetsHtml);
        } else {
            $this->debugLog('Assets disabled');
        }
        return '';
    }

    /**
     * Add CSS filte to assets render
     *
     * @param $url
     * @return $this
     */
    public function addCssFile($url)
    {
        $this->assets['css'][] = $url;

        return $this;
    }

    /**
     * Add JavaScript file to assets render
     *
     * @param $url
     * @param $id
     * @return $this
     */
    public function addJsFile($url, $id = null)
    {
        if (empty($id)) {
            $this->assets['js'][] = $url;
        } else {
            $this->assets['js'][$id] = $url;
        }
        ksort($this->assets['js_code']);

        return $this;
    }

    /**
     * Add JavaScript file to assets render
     *
     * @param $code
     * @param $id
     * @return $this
     */
    public function addJsCode($code, $id = null)
    {
        if (empty($id)) {
            $this->assets['js_code'][] = $code;
        } else {
            $this->assets['js_code'][$id] = $code;
        }
        ksort($this->assets['js_code']);

        return $this;
    }

    /**
     * Full footer generation
     *
     * @return string
     */
    private function generateFooter($content)
    {
        $footer = '';
        //if (!empty($this->facebookPixels)) {
            $facebookPixels = [];
            foreach ($this->facebookPixels as $pixel) {
                $facebookPixels[] = $pixel->getImageCode();
                $this->debugLog('Added Facebook pixel: ' . $pixel->getImageCode());
            }

            if (strpos($content, FacebookPixel::getFullJsCodeSignature()) === false) {
                $facebookInits = [];
                $facebookEvent = '';
                foreach ($this->facebookPixels as $pixel) {
                    $facebookInits[] = $pixel->getJsCode();
                    $facebookEvent = $pixel->getJsCodeEvent() === false ? $facebookEvent : $pixel->getJsCodeEvent();
                }
                $footer .= FacebookPixel::getFullJsCode(
                    implode("\r\n", $facebookInits),
                    implode("\r\n", $facebookPixels),
                    $facebookEvent
                );
            } else {
                $footer .= implode("\r\n", $facebookPixels) . "\r\n";
            }
        //}

        $scripts = implode("\r\n", $this->assets['js_code']);
        if ($scripts) {
            $footer .= "<script>\r\n" . $scripts . "\r\n</script>";
        }

        return $footer;
    }

    /**
     * Event launching before HTML render
     */
    protected function beforeRender()
    {
        if (!empty($_REQUEST['forward'])) {
            $proxy = new Proxy($_REQUEST['forward']);
            echo $proxy->forwardContent();
            die();
        }
        if (!empty($_REQUEST['norender'])) {
            $this->noRender();
        }
        return true;
    }

    /**
     * Evente launching after HTML render
     */
    protected function afterRender()
    {
        return true;
    }

    /**
     * @param $url
     */
    protected function redirect($url)
    {
        header('Location: ' . $url);
    }

    /**
     * Returns the method of the current request (e.g. GET, POST, HEAD, PUT, PATCH, DELETE).
     * @return string request method, such as GET, POST, HEAD, PUT, PATCH, DELETE.
     * The value returned is turned into upper case.
     */
    public function getMethod()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

        return 'GET';
    }

    /**
     * @param bool $isDisabled
     * @return $this
     */
    public function disableProxy($isDisabled = true)
    {
        if ($isDisabled) {
            Proxy::disable();
        } else {
            Proxy::enable();
        }

        return $this;
    }

    public function replaceUrl($url)
    {
        return Proxy::convertUrl($url);
    }

    public function getIsSecureConnection()
    {
        return isset($_SERVER['HTTPS']) && (strcasecmp($_SERVER['HTTPS'],'on')===0 || $_SERVER['HTTPS']==1)
            || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_PROTO'],'https')===0;
    }

    public function getServerUrl()
    {
        return 'http' . ($this->getIsSecureConnection() ? 's' : '') . '://' . $_SERVER['HTTP_HOST'];
    }
}