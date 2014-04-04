<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\View\Model\ViewModel,

	Admin\Form,
	Admin\Model;

class IndexController extends Base
{

    public function indexAction()
    {

    	$serviceLocator = $this->getServiceLocator();
    	$objectManager = $this->getObjectManager();

    	$model = new Model\Admin($serviceLocator, $objectManager);

    	if(!$model->isLogged())
    		return $this->redirect()->toRoute('admin', ['controller' => 'auth', 'action' => 'login']);

        return new ViewModel
        ([

      		

        ]);

    }

}