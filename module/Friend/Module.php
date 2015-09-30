<?php
namespace Friend;

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
                'Friend\Service\FriendService' => function($em){
                    return new FriendService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Friend\Form\FriendForm' => function($em){
                    return new FriendForm($em->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }


}