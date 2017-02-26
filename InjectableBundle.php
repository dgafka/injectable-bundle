<?php
/**
 * Created by PhpStorm.
 * User: dgafka
 * Date: 26.02.17
 * Time: 17:04
 */

namespace CleanCode\Bundle\InjectableBundle;

use CleanCode\Bundle\InjectableBundle\DependencyInjection\ContainerBuilder\InjectableCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class InjectableBundle
 * @package CleanCode\Bundle\InjectableBundle
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class InjectableBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new InjectableCompilerPass());
    }
}