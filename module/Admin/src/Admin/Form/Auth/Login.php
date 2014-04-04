<?php

namespace Admin\Form\Auth;

use Zend\InputFilter\InputFilter,
	Zend\InputFilter\InputFilterProviderInterface;

	//Andreatta\Form\Base as FormBase,
	//Admin\Entity;

class Login extends \Zend\Form\Form implements InputFilterProviderInterface
{
	
    public function __construct($serviceLocator, $objectManager)
    {

        parent::__construct();
		
        $this
				->setAttribute('method', 'post')
				//->setObject(new Entity\Admin())
				//->setHydrator(new DoctrineObject($objectManager))
				->setInputFilter(new InputFilter());
		
		$this

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
					
					'type' => '\Zend\Form\Element\Password',
					'name' => 'password',
					
					'options' => 
					[
						
						'label' => 'Password',
						
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

            'email' => 
			[

                'required' => true,

                'validators' => 
				[
					
					new \Zend\Validator\EmailAddress(),
					
				]

            ],

            'password' => 
			[

                'required' => true,

                'validators' => 
				[
					
					new \Zend\Validator\NotEmpty(),
					
				]

            ],

        ];

    }
	
}