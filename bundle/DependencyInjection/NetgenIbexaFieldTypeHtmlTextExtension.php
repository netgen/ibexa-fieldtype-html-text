<?php

declare(strict_types=1);

namespace Netgen\IbexaFieldTypeHtmlTextBundle\DependencyInjection;

use Netgen\Bundle\OpenGraphBundle\NetgenOpenGraphBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Yaml\Yaml;

use function file_get_contents;

class NetgenIbexaFieldTypeHtmlTextExtension extends Extension implements PrependExtensionInterface
{
    /**
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config'),
        );

        $loader->load('services.yaml');

        /** @var array<class-string> $activatedBundles */
        $activatedBundles = $container->getParameter('kernel.bundles');

        if (in_array(NetgenOpenGraphBundle::class, $activatedBundles, true)) {
            $loader->load('opengraph.yaml');
        }
    }

    public function prepend(ContainerBuilder $container): void
    {
        $this->prependKernelSettings($container);
    }

    public function prependKernelSettings(ContainerBuilder $container): void
    {
        $configFile = __DIR__ . '/../Resources/config/kernel.yaml';
        $config = Yaml::parse(file_get_contents($configFile));
        $container->prependExtensionConfig('ibexa', $config);
        $container->addResource(new FileResource($configFile));
    }
}
