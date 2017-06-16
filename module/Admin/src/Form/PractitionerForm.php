<?php
namespace Admin\Form;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use Admin\Validator\UserExistsValidator;
/**
 * This form is used to collect Practitioner's email, first name, last name, language, phone number, gender, address, overview, qualification, avatar and date added. The form
 * can work in two scenarios - 'create' and 'update'.
 */
class PractitionerForm extends Form
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
    private $practitioner = null;

    /**
     * Constructor.
     */
    public function __construct($scenario = 'create', $entityManager = null, $practitioner = null)
    {
        // Define form name
        parent::__construct('practitioner-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->practitioner = $practitioner;

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
            'name' => 'email',
            'options' => [
                'label' => 'E-mail',
            ],
        ]);

        // Add "first_name" field
        $this->add([
            'type'  => 'text',
            'name' => 'first_name',
            'options' => [
                'label' => 'First Name',
            ],
        ]);

        // Add "last_name" field
        $this->add([
            'type'  => 'text',
            'name' => 'last_name',
            'options' => [
                'label' => 'Last Name',
            ],
        ]);

        // Add "language" field
        $this->add([
            'type'  => 'text',
            'name' => 'language',
            'options' => [
                'label' => 'Language',
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

// add gender field
        $this->add(array(
             'type' => 'Zend\Form\Element\Radio',
             'name' => 'gender',
             'options' => array(
                     'label' => 'What is your gender ?',
                     'value_options' => array(
                             '0' => 'Female',
                             '1' => 'Male',
                     ),
             )
        ));

     // Add "address" field
        $this->add([
            'type'  => 'text',
            'name' => 'address',
            'options' => [
                'label' => 'Phone Number',
            ],
        ]);

        // Add "overview" field
        $this->add([
            'type'  => 'textarea',
            'name' => 'overview',
            'options' => [
                'label' => 'Overview',
            ],
        ]);


        // Add "Qualification" field
        $this->add([
            'type'  => 'select',
            'name' => 'qualification',
            'options' => [
                'label' => 'Qualification',
                'value_options' => [
                    'mbbs' => 'MBBS',
                    'bds' => 'BDS',
                ]
            ],
        ]);


        $file = new Element\File('image-file');
        $file->setLabel('Avatar Image Upload')
             ->setAttribute('id', 'image-file');
        $this->add($file);

        // Add the Submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Create'
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
                'name'     => 'email',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 128
                        ],
                    ],
                    [
                        'name' => 'EmailAddress',
                        'options' => [
                            'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                            'useMxCheck'    => false,
                        ],
                    ],
                    [
                        'name' => UserExistsValidator::class,
                        'options' => [
                            'entityManager' => $this->entityManager,
                            'practitioner' => $this->practitioner
                        ],
                    ],
                ],
            ]);

        // Add input for "first_name" field
        $inputFilter->add([
                'name'     => 'first_name',
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
                'name'     => 'last_name',
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

        // Add input for "language" field
        $inputFilter->add([
                'name'     => 'language',
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
                            'max' => 512
                        ],
                    ],
                ],
            ]);

        // Add input for "gender" field
        $inputFilter->add([
                'name'     => 'gender',
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
        // Add input for "address" field
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
                            'max' => 512
                        ],
                    ],
                ],
            ]);

        // Add input for "overview" field
        $inputFilter->add([
                'name'     => 'overview',
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
    }
}