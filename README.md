# Introduction
 
This bundle allows to locate composer vendor packages inside a Symfony project.
It interprets the `composer.json` in your project root to find the correct vendor
base directory.

The vendor location is configured with a compiler pass, so the path lookup is
stored in DI definition cache.

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

Make sure to flush the cache, to activate the compiler pass.

# Usage

The file locator service is available as service `hylianshield.file_locator.vendor`.

With this service, one can find files relative to the vendor directory:

```php
<?php
/** @var \Symfony\Component\Config\FileLocatorInterface $locator */
$locator = $this->get('hylianshield.file_locator.vendor');

echo $locator->locate('hylianshield/vendor-locator-bundle');
```

Outputs:

```
/path/to/symfony/vendor/hylianshield/vendor-locator-bundle
```
