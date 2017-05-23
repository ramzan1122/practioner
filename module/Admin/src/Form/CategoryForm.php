<?php
namespace Admin\Form;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect category's email, full name, password and status. The form 
 * can work in two scenarios - 'create' and 'update'. In 'create' scenario, category
 * enters password, in 'update' scenario he/she doesn't enter password.
 */
class CategoryForm extends Form
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
     * Current category.
     * @var Admin\Entity\Category 
     */
    private $category = null;
    
    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $category = null)
    {
        // Define form name
        parent::__construct('category-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');
        
        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->category = $category;
        
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
            'name' => 'title',
            'options' => [
                'label' => 'Title',
            ],
        ]);
        
        // Add "parent_id" field
        $this->add([            
            'type'  => 'text',
            'name' => 'parent_id',            
            'options' => [
                'label' => 'Full Name',
            ],
        ]);
        
        if ($this->scenario == 'create') {
        

        }
        
        // Add "status" field
        $this->add([            
            'type'  => 'select',
            'name' => 'status',
            'options' => [
                'label' => 'Status',
                'value_options' => [
                    1 => 'Active',
                    2 => 'Retired',                    
                ]
            ],
        ]);
        
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
                'name'     => 'title',
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
   
                  
                ],
            ]);     


        
        // Add input for "status" field
        $inputFilter->add([
                'name'     => 'status',
                'required' => true,
                'filters'  => [                    
                    ['name' => 'ToInt'],
                ],                
                'validators' => [
                    ['name'=>'InArray', 'options'=>['haystack'=>[1, 2]]]
                ],
            ]);        
    }           
}