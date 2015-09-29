<?php
namespace Profile;

use Profile\Service\ProfileService;
use Profile\Form\ProfileForm;
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
                'Profile\Service\ProfileService' => function($em){
                    return new ProfileService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Profile\Form\ProfileForm' => function($em){
                    return new ProfileForm($em->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }


}
