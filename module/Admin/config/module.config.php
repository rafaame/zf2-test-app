<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

return array(


    'doctrine' => array
    (
        
        'driver' => array
        (
            
            __NAMESPACE__ . '_driver' => array
            (
                
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
                
            ),
            
            'orm_default' => array
            (
                
                'drivers' => array
                (
                    
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                    
                ),
                
            ),
            
        ),
        
    ),
    
    'router' => array(
        'routes' => array(

            'admin' => array
            (
                
                'type' => 'Segment',
                'options' => array
                (
                    
                    //@FIXME: http://stackoverflow.com/questions/20624602/zend-framework-2-wildcard-route
                    'route' => '/admin[/:controller[/:action]][/]',
                    
                    'constraints' => array
                    (
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    
                    'defaults' => array
                    (
                        '__NAMESPACE__' => 'Admin\Controller',
                        'module' => 'Admin',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                    
                ),
                
                'may_terminate' => true,
                'child_routes' => array
                (
                    
                    'wildcard' => array
                    (
                        
                        'type' => 'Wildcard'
                        
                    )
                    
                ),

                'priority' => 1000
                
            ),

        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),

    'controllers' => array(

        'invokables' => array(

            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\User' => 'Admin\Controller\UserController'

        ),

    ),

    'view_manager' => array(

        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(

            'admin/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',

        ),

        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),

        'layouts' => 
        [

            __NAMESPACE__ => 
            [

                /*'Auth' => 'admin/login',

                'Order' =>
                [

                    'print' => 'admin/empty',

                ],*/

                '*' => 'admin/layout'

            ]

        ],

    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
