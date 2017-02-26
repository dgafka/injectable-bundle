<?php

namespace CleanCode\Bundle\InjectableBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Class InjectableExtension
 * @package CleanCode\Bundle\InjectableBundle\DependencyInjection
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class InjectableExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->setParameter('empty_array', []);
    }
}