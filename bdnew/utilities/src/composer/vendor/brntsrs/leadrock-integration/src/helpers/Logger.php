<?php
namespace Leadrock\Helpers;

use Leadrock\Layouts\Layout;

class Logger
{
    private $jsScripts = [
        '//leadrock.com/js-api/logger.js',
    ];

    public function appendTo(Layout $layout)
    {
        foreach ($this->jsScripts as $script) {
            $layout->addJsFile($script);
        }
    }
}