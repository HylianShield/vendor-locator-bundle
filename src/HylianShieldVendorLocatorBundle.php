<?php
namespace HylianShield\VendorLocatorBundle;

use HylianShield\VendorLocatorBundle\DependencyInjection\Compiler\LocatorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @codeCoverageIgnore
 */
class HylianShieldVendorLocatorBundle extends Bundle
{
    /**
     * Add compiler passes to the container.
     *
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new LocatorPass());
    }
}
