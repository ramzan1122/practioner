<?php
namespace Admin\Form;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect Practitioner's email, first name, last name, language, phone number, gender, address, overview, qualification, avatar and date added. The form
 * can work in two scenarios - 'create' and 'update'.
 */
class PracticeForm extends Form
{
    /**
     * Scenario ('create' or 'update').
     * @var string
     */
    private $scenario;

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager = null;

    /**
     * Current practitioner.
     * @var Admin\Entity\User
     */
    private $practice = null;

    /**
     * Constructor.
     */
    public function __construct($scenario = 'create', $entityManager = null, $practice = null)
    {
        // Define form name
        parent::__construct('practice-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->practice = $practice;

        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements()
    {
        // Add "email" field
        $this->add([
            'type'  => 'text',
            'name' => 'practice_name',
            'options' => [
                'label' => 'Practice Name',
            ],
        ]);

        // Add "first_name" field
        $this->add([
            'type'  => 'textarea',
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
        ]);

        // Add "last_name" field
        $this->add([
            'type'  => 'text',
            'name' => 'address',
            'options' => [
                'label' => 'Address',
            ],
        ]);
        
        $this->add([
            'type'  => 'text',
            'name' => 'state',
            'options' => [
                'label' => 'State',
            ],
        ]);
        
        $this->add([
            'type'  => 'text',
            'name' => 'suburb',
            'options' => [
                'label' => 'Suburb',
            ],
        ]);
        
        $this->add([
            'type'  => 'text',
            'name' => 'postal_code',
            'options' => [
                'label' => 'Postal Code',
            ],
        ]);
        
        // Add "language" field
        $this->add([
            'type'  => 'text',
            'name' => 'languages',
            'options' => [
                'label' => 'Languages',
            ],
        ]);

        // Add "phone_number" field
        $this->add([
            'type'  => 'text',
            'name' => 'phone_number',
            'options' => [
                'label' => 'Phone Number',
            ],
        ]);


     // Add "address" field
        $this->add([
            'type'  => 'hidden',
            'name' => 'latitude',
            'options' => [],
        ]);

        // Add "overview" field
        $this->add([
            'type'  => 'hidden',
            'name' => 'longitude',
            'options' => [],
        ]);


        $file = new Element\File('logo');
        $file->setLabel('Practice Logo')
             ->setAttribute('id', 'logo');
        $this->add($file);

        // Add the Submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Create'
            ],
        ]);
        
        $this->add([
            'type'  => 'submit',
            'name' => 'save',
            'attributes' => [
                'value' => 'Update'
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter()
    {
        // Create main input filter
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        // Add input for "email" field
        $inputFilter->add([
                'name'     => 'practice_name',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 255
                        ],
                    ]
                ],
            ]);

        // Add input for "first_name" field
        $inputFilter->add([
                'name'     => 'description',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 512
                        ],
                    ],
                ],
            ]);
        // Add input for "last_name" field
        $inputFilter->add([
                'name'     => 'address',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 800
                        ],
                    ],
                ],
            ]);
        
             $inputFilter->add([
                'name'     => 'state',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 255
                        ],
                    ],
                ],
            ]);
             
        $inputFilter->add([
                'name'     => 'suburb',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 255
                        ],
                    ],
                ],
            ]);

        // Add input for "language" field
       
        $inputFilter->add([
                'name'     => 'postal_code',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 10
                        ],
                    ],
                ],
            ]);
            
        $inputFilter->add([
                'name'     => 'languages',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 255
                        ],
                    ],
                ],
            ]);
        
        // Add input for "phone_number" field
        $inputFilter->add([
                'name'     => 'phone_number',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 30
                        ],
                    ],
                ],
            ]);

        // Add input for "gender" field
        $inputFilter->add([
                'name'     => 'latitude',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 20
                        ],
                    ],
                ],
            ]);
        // Add input for "address" field
        $inputFilter->add([
                'name'     => 'longitude',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 20
                        ],
                    ],
                ],
            ]);

    }
}