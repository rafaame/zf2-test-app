<?php

namespace Admin\Model;

use Admin\Entity;

//@TODO: create a general module that will contain a base class for the model
class Admin
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

	/**
	 * 
	 * @return Zend\Authentication\AuthenticationService
	 */
	protected function getAuthenticationService()
	{
		
		$serviceLocator = $this->getServiceLocator();
		
		return $serviceLocator->get('Admin\Auth');
		
	}
	
	/**
	 * 
	 * @return Zend\Authentication\Adapter\AdapterInterface
	 */
	protected function getAuthenticationAdapter()
	{
		
		return $this->getAuthenticationService()->getAdapter();
		
	}

	public function __construct($serviceLocator, $objectManager)
	{

		$this->serviceLocator = $serviceLocator;
		$this->objectManager = $objectManager;

	}

	public function isLogged()
	{

		$authService = $this->getAuthenticationService();
		
    	return $authService->hasIdentity();

	}
	
	public function getCurrent()
	{
		$authService = $this->getAuthenticationService();
		
    	if($authService->hasIdentity())
			return $authService->getIdentity();
		
		return null;
	}
	
	public function authenticate($identity, $credential)
	{
		
		$authService = $this->getAuthenticationService();
		$authAdapter = $this->getAuthenticationAdapter();
		
		$authAdapter->setIdentityValue($identity);
		$authAdapter->setCredentialValue($credential);
		$result = $authService->authenticate();
				
		return $result->isValid();
		
	}
	
	public function logout()
	{
		
		$authService = $this->getAuthenticationService();
		
		if($authService->hasIdentity())
		{
			
			$authService->clearIdentity();
			
			return true;
			
		}
		
		return false;
		
	}

	public function save(Entity\Admin $entity)
	{

		$objectManager = $this->getObjectManager();

		$objectManager->persist($entity);
		$objectManager->flush();

	}

	public function remove(Entity\Admin $entity)
	{

		$objectManager = $this->getObjectManager();

		$objectManager->remove($entity);
		$objectManager->flush();

	}

}