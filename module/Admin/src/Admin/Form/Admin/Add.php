<?php

namespace Admin\Form\Admin;

use Zend\InputFilter\InputFilter,
	Zend\InputFilter\InputFilterProviderInterface,
	DoctrineModule\Stdlib\Hydrator\DoctrineObject,

	Admin\Entity;

class Add extends Base
{
	
    public function __construct($serviceLocator, $objectManager)
    {

        parent::__construct($serviceLocator, $objectManager);
		
	}

	/**
     * @return array
     */
    public function getInputFilterSpecification()
    {

        return array_merge(parent::getInputFilterSpecification(),
        [

        	

        ]);

    }
	
}