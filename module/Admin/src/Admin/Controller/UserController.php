<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
	Zend\View\Model\ViewModel,

	Admin\Form,
	Application\Model;

class UserController extends AbstractActionController
{

	protected function getObjectManager()
	{

		$serviceLocator = $this->getServiceLocator();

    	return $serviceLocator->get('Doctrine\ORM\EntityManager');

	}

    public function indexAction()
    {

    	$objectManager = $this->getObjectManager();

    	$users = $objectManager
                    ->getRepository('Application\Entity\User')
                    ->findBy([]);

        return new ViewModel
        ([

        	'users' => $users

        ]);

    }

    public function addAction()
    {

    	$serviceLocator = $this->getServiceLocator();
    	$objectManager = $this->getObjectManager();

		$form = new Form\User\Add($serviceLocator, $objectManager);

    	if($this->request->isPost())
    	{

    		$data = $this->request->getPost();
    		$form->setData($data);

    		if($form->isValid())
    		{

    			$entity = $form->getData();

    			//Don't use the object manager directly in the controller!
    			//$objectManager->persist($entity);
    			//$objectManager->flush();

    			$model = new Model\User($serviceLocator, $objectManager);
    			$model->save($entity);

		    	if($entity->getId())
		    	{

		    		$this->flashMessenger()->addSuccessMessage('User successfully added to the database.');

					return $this->redirect()->toRoute('admin', ['controller' => 'user']);

		    	}
		    	else
		    		$this->flashMessenger()->addErrorMessage('There was an error adding the user to the database. Contact the administrator.');

		    }

    	}

    	return new ViewModel
    	([

			'form' => $form,

		]);

    }

    public function editAction()
    {

    	$serviceLocator = $this->getServiceLocator();
    	$objectManager = $this->getObjectManager();

    	$id = $this->getEvent()->getRouteMatch()->getParam('id');
		$entity = $objectManager
					->getRepository('Application\Entity\User')
					->findOneBy(['id' => $id]);

		$form = new Form\User\Add($serviceLocator, $objectManager);

		if($entity)
		{

			$form->bind($entity);

	    	if($this->request->isPost())
	    	{

	    		$data = $this->request->getPost();
	    		$form->setData($data);

	    		if($form->isValid())
	    		{

					$model = new Model\User($serviceLocator, $objectManager);
    				$model->save($entity);

		    		$this->flashMessenger()->addSuccessMessage('User successfully saved to the database.');
		    		return $this->redirect()->toRoute('admin', ['controller' => 'user']);

			    }

	    	}

		}
		else
			$this->flashMessenger()->addErrorMessage('Could not find an user with the id you specified.');

		return new ViewModel
    	([

			'form' => $form,

		]);

    }

    public function deleteAction()
    {

    	$objectManager = $this->getObjectManager();

    	$id = $this->getEvent()->getRouteMatch()->getParam('id');
		$entity = $objectManager
					->getRepository('Application\Entity\User')
					->findOneBy(['id' => $id]);

		if($entity)
		{

			$model = new Model\User($serviceLocator, $objectManager);
    		$model->remove($entity);

			$this->flashMessenger()->addSuccessMessage('User successfully deleted from the database.');

		}
		else
			$this->flashMessenger()->addErrorMessage('Could not find an user with the id you specified.');

		return $this->redirect()->toRoute('admin', ['controller' => 'user']);

    }

}