Leadrock integration library
=======================

[![Latest Version](https://img.shields.io/github/release/brntsrs/leadrock-integration.svg?style=flat-square)](https://github.com/brntsrs/leadrock-integration/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/brntsrs/leadrock-integration.svg?style=flat-square)](https://packagist.org/packages/brntsrs/leadrock-integration)
[Apidoc](https://leadrock.com/apidoc/)

## Installing guide

The recommended way to install package is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of package:

```bash
php composer.phar require brntsrs/leadrock-integration
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can then later update package using composer:

 ```bash
composer.phar update
 ```

See integration options in **example** folder to your quick use.

### Auto-update script file without composer

You can download auto-update\install file from our server: [https://leadrock.com/integration/updater](https://leadrock.com/integration/updater).
Upload this file to your landing, grant write access to your folder for the script and call it 
from your browser as this: http://example.com/landing/leadrock-install.php

The script will download integration package `leadrock-integration.phar`, that you can use instead of
composer autoload classes as any other PHP-file:
```php
<?php
include 'leadrock-integration.phar';
```

Anytime you whant you can call installation script again and get updated `leadrock-integration.phar` 
file.

### Full quick integration with config file

You can use config file with settings that used globaly on your landing with thank-you page to avoid 
separated landing integration and thankyou-page integration. See default config:

```php
<?php
return [
    'layout' => 'landing', // integration type (landing or prelanding)
    'thankyou_page' => 'thankyou.php', // your thankyou page
 
    'track_param' => 'track_id', // url param where track ID can be found
 
    'facebook_id' => '123321123321,123321123322', // multiple ids can be separated by comma
    'facebook_from_param' => 'fbpixel', // url param where Facebook pixel ID can be found
    'facebook_landing_goal' => 'PageView', // Facebook event on landing page
    'facebook_thankyou_goal' => 'Purchase', // Facebook event on thankyou page
 
    'api_key' => '1278g3',
    'api_secret' => 'o4ircshboiuerbvs',
    'save_in_file' => 'leads.log', // file path to backup lead data
 
    'form' => [ //form param names as param => field_name
        //<input name="phone" />
        'user_phone' => 'phone',
        //<input name="name" />
        'user_name' => 'name',
        //<input name="email" />
        'user_email' => 'email',
        //<input name="other" />
        'other' => 'other',
        //<input name="price" />
        'price' => 'price',
    ]
];
```

Also create two files:

_index.php_ 
```php
<?php
include 'vendor/autoload.php';

$config = new \Leadrock\Items\Config('config.php');
$integration = new \Leadrock\Integration($config);
 
include 'landing.html';
 
$integration->end();
```

and _thankyou.php_
```php
<?php
include 'vendor/autoload.php';

$config = new \Leadrock\Items\Config('config.php');
$integration = new \Leadrock\Integration($config);
 
include 'thankyou.html';
 
$integration->end();
```

All other settings will be done by config and integration scripts. To use more detailed settings
use integration below.

### Landing intagration
Add _index.php_ along with your html file, rename html template to something like _template.html_, 
so you can separate html code from php integration code to your easy use.

In php file you shold use header and footer integration, specifying settings in header and including
your template file in the middle:

```php
<?php
include 'vendor/autoload.php';

$integration = new \Leadrock\Layouts\Landing();
$integration
    ->findTrackIn('track_id')
    ->addProvider(new \Leadrock\Providers\File('leads_log.txt'))
    ->addProvider(new \Leadrock\Providers\Leadrock('1278g3', 'so4ircshboiuerbvs'))
    ->setFormField('user_name', 'name')
    ->setFormField('user_phone', 'phone')
    ->setFormField('other', 'other');
 
include 'template.html';
 
$integration->end();
```

Code above will catch provided track ID from GET param (track_id as sprcified above), store it in
cookies and session storage, will add extra Facebook data (if it will be provided in deafult GET 
params) to the end of the page and render template to user. On POST request form data will be parsed
according to field settings and new lead created, then provided to file and API request.

There are two ways to save lead data: in file for backup reasons and directly to Leadrock platform
via API. To use API spedify your API key and secret password (you can find them in profile settigns).

Use form parameters settings method to store form data to provider (file or API), by default used
`user_phone`, `user_name`, `price`, `user_email`, `other`.


### Pre-landing intagration

Add _index.php_ along with your html file, rename html template to something like _template.html_, 
so you can separate html code from php integration code to your easy use.

In php file you shold use header and footer integration, specifying settings in header and including
your template file in the middle:

```php
<?php
include 'vendor/autoload.php';

$integration = new \Leadrock\Layouts\PreLanding();
$integration
    ->findTrackIn('track_id')
    ->setWebmasterLink('https://leadrock.com/URL-QW123-ER4567');
 
include 'template.html';
 
$integration->end();
```

Code above will store track ID (from track_id param) to cookies and session, also use provided
webmaster link to replace all links in template before render it to user. Next user click on any link
will be redirected by platrofm to your specifyed landing.

In case of unknown webmaster URL (multiple webmasters using same landing or pre-landing) extra param
can be used to link replacements (or track-click when used in landing):

```php
<?php
include 'vendor/autoload.php';

$integration = new \Leadrock\Layouts\PreLanding();
$integration
    ->findTrackIn('track_id')
    ->setWebmasterLinkFromParam('link');
 
include 'template.html';
 
$integration->end();
```

In case of abscense webmaster setted thankyou-page url (in offer link settings ot other options)
you can set default url to redirect after form submission:

```php
<?php
$integration->setThankyouPage('thankyou.php');
```

### ThankYou page integration

Add _thankyou.php_ along with your html file, rename html template to something like _thankyou.html_, 
so you can separate html code from php integration code to your easy use.


```php
<?php
include 'vendor/autoload.php';

$integration = new \Leadrock\Layouts\ThankYou();
 
include 'thankyou.html';
 
$integration->end();
```

You can use extra Facebook setting in each layout type, see above.

### Facebook tracking pixels
You can add your own Facebook pixel by adding ID to constructor:

```php
<?php
$pixel2 = new \Leadrock\Items\FacebookPixel('111111111112');
$pixel3 = new \Leadrock\Items\FacebookPixel('111111111113');
$integration
    ->addFacebookPixel($pixel2)
    ->addFacebookPixel($pixel3);
```

Multiple Facebook pixels will work fine. Also you can change catch param:

```php
<?php
$pixel = (new \Leadrock\Items\FacebookPixel())->findFrom('fbpixel');
$integration->addFacebookPixel($pixel);
```

Pixel events can be changed on different pages:
```php
<?php
$pixel = new \Leadrock\Items\FacebookPixel('111111111112');
$pixel->setEvent('Purchase');
$integration->addFacebookPixel($pixel);
```

Additional to event price and currency can be placed:
```php
<?php
$pixel = new \Leadrock\Items\FacebookPixel('111111111112');
$pixel->setEvent('Purchase')->setPrice(10, 'USD');
$integration->addFacebookPixel($pixel);
```

### Direct links

Two options available to use direct landing links without tracking redirect: using tracking URL in 
config or provide tracking URL in params:

```php
<?php
$integration->setWebmasterLink('https://leadrock.com/URL-XY123-ZA456');
```

or

```php
<?php
$integration->setWebmasterLinkFromParam('url');
```

### Advertiser integration

If you do not need any landing based integration and you are looking for direct request send 
(e.g. for you CRM integration), you can simplify all integration process to Lead handler:

```php
<?php
$trackId = '10001.1234567890';
 
$lead = new \Leadrock\Items\Lead($trackId);
$lead->addProvider(
    new \Leadrock\Providers\Leadrock('1278g3', 'so4ircshboiuerbvs')
);
$lead->setParam('user_name', 'Han Solo');
$lead->setParam('other', 'on Millenium Falcon');
$lead->setParam('user_phone', '+1 555 0000000');
$lead->save();
 
$lead->changeStatus(Leadrock\Items\Lead::STATUS_APPROVED);
$lead->save();
 
$lead->changeStatus(Leadrock\Items\Lead::STATUS_REJECTED);
$lead->save();
```

## Help and docs

- [Leadrock website](https://leadrock.com/)
- [Help and FAQ](https://leadrock.com/webmaster/reference)
- [Support ticket system](https://leadrock.com/webmaster/support)


## Platform information

LeadRock is a leading affiliate network with TOP offers and performance solutions 
for advertisers and media partners worldwide.

- Native call-center speakers in each country
- Best exclusive offers worldwide
- Excellent EPC
- Highest rates for affiliates
