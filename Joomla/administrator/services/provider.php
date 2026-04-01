<?php
defined('_JEXEC') or die;

use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\Factory;

use Joomla\Component\Quiz\Administrator\Extension\QuizComponent;

return new class implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $namespace = '\\Joomla\\Component\\Quiz';

        $container->registerServiceProvider(new ComponentDispatcherFactory($namespace));
        $container->registerServiceProvider(new MVCFactory($namespace));

        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new QuizComponent(
                    $container->get(ComponentDispatcherFactoryInterface::class)
                );
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                return $component;
            }
        );
    }
};