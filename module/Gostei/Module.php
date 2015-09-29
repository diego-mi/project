<?php
namespace Gostei;

use Gostei\Service\GosteiService;
use Gostei\Form\GosteiForm;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Gostei\Service\GosteiService' => function($em){
                    return new GosteiService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Gostei\Form\GosteiForm' => function($em){
                    return new GosteiForm($em->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }


}
