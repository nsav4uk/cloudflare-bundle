<?php declare(strict_types=1);

namespace nsav4uk\CloudflareBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('cloudflare');

        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('email')->isRequired()->end()
                ->scalarNode('api_key')->isRequired()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
