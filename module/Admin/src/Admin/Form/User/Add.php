<?php

namespace Admin\Form\User;

use Zend\InputFilter\InputFilter,
	Zend\InputFilter\InputFilterProviderInterface,
	DoctrineModule\Stdlib\Hydrator\DoctrineObject,

	//Andreatta\Form\Base as FormBase,
	Application\Entity;

class Add extends \Zend\Form\Form implements InputFilterProviderInterface
{
	
    public function __construct($serviceLocator, $objectManager)
    {

        parent::__construct();
		
        $this
				->setAttribute('method', 'post')
				->setObject(new Entity\User())
				->setHydrator(new DoctrineObject($objectManager))
				->setInputFilter(new InputFilter());
		
		$this

				->add(
				[
					
					'type' => '\Zend\Form\Element\Text',
					'name' => 'name',
					
					'options' => 
					[
						
						'label' => 'Name',
						
					],
					
					'attributes' => 
					[
						
						'required' => 'required',
						
					],
					
				])

				->add(
				[
					
					'type' => '\Zend\Form\Element\Email',
					'name' => 'email',
					
					'options' => 
					[
						
						'label' => 'Email',
						
					],
					
					'attributes' => 
					[
						
						'required' => 'required',
						
					],
					
				])

				->add(
				[
					
					'type' => '\Zend\Form\Element\Submit',
					'name' => 'submit',
					
					'attributes' => 
					[
						
						'value' => 'Submit',
						
					],
					
				]);
		
	}

	/**
     * @return array
     */
    public function getInputFilterSpecification()
    {

        return
		[
			
            'name' => 
			[

                'required' => true,

                'validators' => 
				[
					
					new \Zend\Validator\NotEmpty(),
					
				]

            ],

            'email' => 
			[

                'required' => true,

                'validators' => 
				[
					
					new \Zend\Validator\EmailAddress(),
					
				]

            ],

        ];

    }
	
}