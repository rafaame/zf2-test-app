<?php

namespace Application\Model;

use Application\Entity;

class User
{

	private $serviceLocator;
	private $objectManager;

	protected function getServiceLocator()
	{

		return $this->serviceLocator;

	}

	protected function getObjectManager()
	{

		return $this->objectManager;

	}

	public function __construct($serviceLocator, $objectManager)
	{

		$this->serviceLocator = $serviceLocator;
		$this->objectManager = $objectManager;

	}

	public function save(Entity\User $entity)
	{

		$serviceLocator = $this->getServiceLocator();
		$objectManager = $this->getObjectManager();

		$modelAdmin = new \Admin\Model\Admin($serviceLocator, $objectManager);

		if($loggedAdmin = $modelAdmin->getCurrent())
			$entity->setRegisteredBy($loggedAdmin);

		$objectManager->persist($entity);
		$objectManager->flush();

	}

	public function remove(Entity\User $entity)
	{

		$objectManager = $this->getObjectManager();

		$objectManager->remove($entity);
		$objectManager->flush();

	}

}