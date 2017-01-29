# Introduction
 
This bundle allows to locate vendor packages inside a Symfony project.

# Installation

```shell
composer require hylianshield/vendor-locator-bundle:^1.0
```

Add the following bundle to the app kernel.

```php
<?php
use HylianShield\VendorLocatorBundle\HylianShieldVendorLocatorBundle;

//...
class AppKernel extends Kernel
{
    // ...
    public function registerBundles()
    {
        $bundles = [
            // ...
            new HylianShieldVendorLocatorBundle()
        ];
        // ...
    }
    // ...
}
```

# Usage

