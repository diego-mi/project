<?php
namespace Friend;

return array(
    'router' => array(
        'routes' => array(
            'friend' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/friend',
                    'defaults' => array(
                        'controller' => 'Friend\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'friend-followers' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/ver-seguidores',
                    'defaults' => array(
                        'controller' => 'Friend\Controller\Index',
                        'action' => 'ver-Seguidores',
                    ),
                ),
            ),
            'friend-following' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/ver-seguindo',
                    'defaults' => array(
                        'controller' => 'Friend\Controller\Index',
                        'action' => 'ver-Seguindo',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Friend\Controller\Index' => 'Friend\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
);

