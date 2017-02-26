<?php

namespace CleanCode\Bundle\InjectableBundle\DependencyInjection\ContainerBuilder;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class InjectableCompilerPass
 * @package CleanCode\Bundle\InjectableBundle\DependencyInjection
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class InjectableCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $injectTo = [];
        $taggedServices = $container->findTaggedServiceIds(
            'injectable'
        );
        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $injectTo[$attributes['to']][$attributes['index']][] = new Reference($id);
            }
        }
        foreach ($injectTo as $injectableServiceName => $referencesOnArgumentIndex) {
            $definition = $container->getDefinition($injectableServiceName);
            foreach ($referencesOnArgumentIndex as $argumentIndex => $references) {
                $definition->replaceArgument($argumentIndex, $references);
            }
        }
    }
}