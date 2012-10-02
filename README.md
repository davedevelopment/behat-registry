behat-registry
==============

What is it?
-----------

A little extension that allows a simple registry to be injected in to
FeatureContexts, allowing steps to share data across contexts if necessary

Installation
------------

The only documented way to install behat-registry is with
[composer](http://getcomposer.org)

``` bash
$ composer.phar require --dev davedevelopment/behat-registry:* 
```

Usage
-----

Add the extension to your `behat.yml` file:

``` yaml
default:
    extensions:
        DaveDevelopment\BehatRegistry\Extension:

```

If you implement the
`DaveDevelopment\BehatRegistry\Context\Initializer\RegistryAwareInterface` with
your `Context` classes, they will have a Registry injected. By default the
registry will have a parameters key that contains the context parameters.

``` php
<?php 

use DaveDevelopment\BehatRegistry\Context\Initializer\RegistryAwareInterface;
use DaveDevelopment\BehatRegistry\Registry;

class FeatureContext implements RegistryAwareInterface
{
    public function setRegistry(Registry $registry)
    {
        $this->registry = $registry;
    }


```

If you want some items to persist between scenarios, call the persist method
(the parameters are persisted between scenarios).

``` php
<?php

    $this->registry->userId = 123;
    $this->registry->persist("userId");

```

Copyright
---------

Copyright (c) 2012 Dave Marshall. See LICENCE for further details
