<?php

namespace Admin\Form\Admin;

use Zend\InputFilter\InputFilter,
	Zend\InputFilter\InputFilterProviderInterface,
	DoctrineModule\Stdlib\Hydrator\DoctrineObject,

	Admin\Entity;

class Edit extends Base
{
	
    public function __construct($serviceLocator, $objectManager)
    {

        parent::__construct($serviceLocator, $objectManager);

        $this->get('password')->removeAttribute('required');
		
	}

	/**
     * @return array
     */
    public function getInputFilterSpecification()
    {

        return array_merge(parent::getInputFilterSpecification(),
        [

        	'password' => 
			[

                'required' => false,

                'validators' => 
				[
					
					
					
				]

            ],

        ]);

    }
	
}