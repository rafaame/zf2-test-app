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

class AuthController extends Base
{

    public function indexAction()
    {

    	

    }

    public function loginAction()
    {

    	$serviceLocator = $this->getServiceLocator();
    	$objectManager = $this->getObjectManager();

    	$model = new Model\Admin($serviceLocator, $objectManager);

    	if($model->isLogged())
    		return $this->redirect()->toRoute('admin');

    	$form = new Form\Auth\Login($serviceLocator, $objectManager);

    	if($this->request->isPost())
    	{

    		$form->setData($this->request->getPost());

    		if($form->isValid())
    		{

    			$data = $form->getData();

    			$success = $model->authenticate($data['email'], $data['password']);

    			if($success)
    			{

    				$this->flashMessenger()->addSuccessMessage('Logged successfully.');

					return $this->redirect()->toRoute('admin');

    			}
    			else
    				$this->flashMessenger()->addErrorMessage('Login failed.');

    		}

    	}

    	return new ViewModel
    	([

    		'form' => $form,

    	]);

    }

    public function logoutAction()
    {

    	$serviceLocator = $this->getServiceLocator();
    	$objectManager = $this->getObjectManager();

    	$model = new Model\Admin($serviceLocator, $objectManager);

    	$model->logout();

    	$this->flashMessenger()->addSuccessMessage('Logged out successfully.');

		return $this->redirect()->toRoute('admin', ['controller' => 'auth', 'action' => 'login']);

    }

}