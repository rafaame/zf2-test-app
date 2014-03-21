<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {

        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $application = $e->getParam('application');
        $application->getEventManager()->attach('dispatch', array($this, 'setModuleLayout'));

    }

    public function setModuleLayout($e)
    {

        $application = $e->getParam('application');

        $request = $application->getServiceManager()->get('Request');
        if(!$request instanceof \Zend\Http\Request)
            return;
        
        $config = $application->getServiceManager()->get('config');
        $layouts = $config['view_manager']['layouts'];
        $matches = $e->getRouteMatch();
        $module = $matches->getParam('module');

        if(!isset($layouts[$module]))
            return;

        $controller = explode('\\', $matches->getParam('controller'));
        $controller = array_pop($controller);
        $action = $matches->getParam('action');
        $layout = null;

        foreach($layouts as $layoutModule => $moduleLayouts)
        {

            if($module == $layoutModule || $layoutModule == '*')
            {

                if(is_array($moduleLayouts))
                {

                    foreach($moduleLayouts as $layoutController => $controllerLayouts)
                    {

                        if($controller == $layoutController || $layoutController == '*')
                        {

                            if(is_array($controllerLayouts))
                            {

                                foreach($controllerLayouts as $layoutAction => $actionLayout)
                                {

                                    if($action == $layoutAction || $layoutAction == '*')
                                    {

                                        $layout = $actionLayout;
                                        break;

                                    }

                                }

                                if($layout)
                                    break;

                            }
                            else
                            {

                                $layout = $controllerLayouts;
                                break;

                            }

                        }


                    }

                    if($layout)
                        break;

                }
                else
                {

                    $layout = $moduleLayouts;
                    break;

                }

            }

        }

        $controller = $e->getTarget();
        $controller->layout($layout);

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
}
