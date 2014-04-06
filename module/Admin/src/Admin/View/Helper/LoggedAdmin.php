<?php

namespace Admin\View\Helper;

use Zend\View\Helper\AbstractHelper,
	Zend\ServiceManager\ServiceLocatorAwareInterface,

	Admin\Model;

class LoggedAdmin extends AbstractHelper implements ServiceLocatorAwareInterface
{

	use \Zend\ServiceManager\ServiceLocatorAwareTrait;

    public function __invoke()
    {

    	$serviceLocator = $this->getServiceLocator()->getServiceLocator();

    	//@TODO: make objectManager argument optional for models
    	$model = new Model\Admin($serviceLocator, $serviceLocator->get('Doctrine\ORM\EntityManager'));

    	return $model->getCurrent();
		
	}
	
}