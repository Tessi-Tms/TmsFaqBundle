TmsFaqBundle
=========================

Symfony 2 bundle to manage Faq

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

Then install the bundle with the command:

```sh
php composer update
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

Not forget to install asset
```sh
php app/console assets:install --symlink
```

Now the Bundle is installed.
