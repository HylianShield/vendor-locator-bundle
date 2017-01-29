<?php
namespace HylianShield\VendorLocatorBundle\DependencyInjection\Compiler;

use Composer\Config;
use Composer\Json\JsonFile;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @codeCoverageIgnore
 */
class LocatorPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('hylianshield.file_locator.vendor')) {
            return;
        }

        $definition = $container->getDefinition(
            'hylianshield.file_locator.vendor'
        );

        $packageFinder = new Finder();
        $packageFinder
            ->depth(0)
            ->files()
            ->in([
                dirname($container->getParameter('kernel.root_dir')),
                $container->getParameter('kernel.root_dir')
            ])
            ->name('composer.json');

        $definition->replaceArgument(
            0,
            array_map(
                function (SplFileInfo $package) : string {
                    return $this->getVendorPath($package);
                },
                iterator_to_array($packageFinder)
            )
        );
    }

    /**
     * Get the vendor path for the given composer package file.
     *
     * @param SplFileInfo $composerPackage
     *
     * @return string
     */
    public function getVendorPath(SplFileInfo $composerPackage): string
    {
        return realpath(
            $this
                ->getComposerConfig($composerPackage)
                ->get('vendor-dir', 0)
        );
    }

    /**
     * Get the composer config for the given package file.
     *
     * @param SplFileInfo $composerPackage
     *
     * @return Config
     */
    public function getComposerConfig(SplFileInfo $composerPackage): Config
    {
        $config = new Config(true, dirname($composerPackage->getRealPath()));
        $config->setConfigSource(
            new Config\JsonConfigSource(
                new JsonFile($composerPackage->getRealPath())
            )
        );

        return $config;
    }
}
