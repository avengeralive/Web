<?php
namespace Leadrock\Layouts;

use Leadrock\Helpers\Storage;
use Leadrock\Items\FacebookPixel;

class ThankYou extends Layout
{
    public function beforeRender()
    {
        $fbPixelId = Storage::restoreParam(Storage::FB_PIXEL_ID);
        if (!empty($fbPixelId)) {
            $this->addFacebookPixel(new FacebookPixel($fbPixelId));
        }
        return parent::beforeRender();
    }
}