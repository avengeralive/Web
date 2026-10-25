<?php
namespace Leadrock;

use Leadrock\Items\Config;
use Leadrock\Items\FacebookPixel;
use Leadrock\Layouts\Landing;
use Leadrock\Layouts\Layout;
use Leadrock\Layouts\ThankYou;
use Leadrock\Providers\File;
use Leadrock\Providers\Leadrock;

class Integration
{
    /**
     * @var Config
     */
    private $config;
    /**
     * @var Layout
     */
    private $layout;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Prerendering params definition
     * Should be called before html start
     */
    public function start()
    {
        $this->layout = new ($this->config->getLayoutClass());
        $this->setTrackId();
        $this->setProviders();
        $this->setFacebook();
        $this->setFormParams();
    }

    /**
     * Onrender integration processes
     * Shold be called after html end
     */
    public function end()
    {
        $this->layout->end();
    }

    /**
     * Read track ID param from config and add to layout settings
     */
    private function setTrackId()
    {
        if ($this->isThisIsLanding()) {
            $this->layout->findTrackIn($this->config->getParam(Config::PARAM_TRACK_ID_PARAM));
            $trackUrlParam = $this->config->getParam(Config::PARAM_TRACK_LINK_IN_PARAM);
            if (!empty($trackUrlParam)) {
                $this->layout->setWebmasterLinkFromParam($trackUrlParam);
            } else {
                $trackUrl = $this->config->getParam(Config::PARAM_TRACK_LINK);
                if (!empty($trackUrl)) {
                    $this->layout->setWebmasterLink($trackUrl);
                }
            }
        }
    }

    /**
     * Read save provider from config and add to layout settings
     */
    private function setProviders()
    {
        if ($this->isThisIsLanding()) {
            $filePath = $this->config->getParam(Config::PARAM_SAVE_IN_FILE);
            if (!empty($filePath)) {
                $this->layout->addProvider(new File($filePath));
            }

            $apiKey = $this->config->getParam(Config::PARAM_API_KEY);
            $apiSecret = $this->config->getParam(Config::PARAM_API_SECRET);
            if (!empty($apiKey) && !empty($apiSecret)) {
                $this->layout->addProvider(new Leadrock($apiKey, $apiSecret));
            }
        }
    }

    /**
     * Read form field paramd from config and add to layout settings
     */
    private function setFormParams()
    {
        if ($this->isThisIsLanding()) {
            $this->layout->setFormFields($this->config->getParam(Config::PARAM_FORM));
            $this->layout->setThankyouPage($this->config->getParam(Config::PARAM_THANKYOU_PAGE));
        }
    }

    /**
     * Read Facebook params from config and add to layout settings
     */
    private function setFacebook()
    {
        $goal = $this->isThisIsThankYouPage() ?
            $this->config->getParam(Config::PARAM_FACEBOOK_THANKYOU_GOAL) :
            $this->config->getParam(Config::PARAM_FACEBOOK_LANDING_GOAL);

        $fbId = $this->config->getParam(Config::PARAM_FACAEBOOK_ID);
        if (!empty($fbId)) {
            $ids = preg_split('/[^\d]+/', $fbId);
            foreach ($ids as $id) {
                if (!empty($id)) {
                    $this->layout->addFacebookPixel(
                        (new FacebookPixel($id))->setEvent($goal)
                    );
                }
            }
        }

        $getParam = $this->config->getParam(Config::PARAM_FACEBOOK_GET_PARAM);
        if (!empty($getParam)) {
            $this->layout->addFacebookPixel(
                (new FacebookPixel())->findFrom($getParam)->setEvent($goal)
            );
        }
    }

    private function isThisIsThankYouPage()
    {
        return $this->layout instanceof ThankYou;
    }

    private function isThisIsLanding()
    {
        return $this->layout instanceof Landing;
    }
}