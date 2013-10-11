TmsFaqBundle
============

Symfony 2 bundle to manage Faq

TmsFaqClientBundle is an API which allow to call easily the web service -> see the documentation: https://github.com/Tessi-Tms/TmsFaqClientBundle

Installation
============

To install this bundle please follow the next steps:

First add the dependency in your `composer.json` file:
```json
"repositories": [
    ...,
    {
        "type": "vcs",
        "url": "https://github.com/Tessi-Tms/TmsFaqBundle.git"
    }
],
"require": {
        ...,
        "tms/faq-bundle": "dev-master"
    },
```

Enable the bundle in your application kernel:
```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        //
        new Tms\Bundle\FaqBundle\TmsFaqBundle(),
    );
}
```

Then install the bundle with the command:
```sh
php composer update
```

Not forget to update schema with command:
```sh
php app/console doctrine:schema:update --force
```

Now the Bundle is installed.
