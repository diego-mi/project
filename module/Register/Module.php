<?php
namespace Register;

use Register\Service\RegisterService;
use Register\Form\RegisterForm;
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
                'Register\Service\RegisterService' => function($em){
                    return new RegisterService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Register\Form\RegisterForm' => function($em){
                    return new RegisterForm($em->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }


}
