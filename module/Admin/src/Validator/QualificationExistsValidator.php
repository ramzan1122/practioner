<?php
namespace Admin\Validator;
use Zend\Validator\AbstractValidator;
use Admin\Entity\Qualification;
/**
 * This validator class is designed for checking if there is an existing user 
 * with such an email.
 */
class QualificationExistsValidator extends AbstractValidator 
{
    /**
     * Available validator options.
     * @var array
     */
    protected $options = array(
        'entityManager' => null,
        'qualification' => null
    );
    
    // Validation failure message IDs.
    const NOT_SCALAR  = 'notScalar';
    const QUALIFICATION_EXISTS = 'qualificationExists';
        
    /**
     * Validation failure messages.
     * @var array
     */
    protected $messageTemplates = array(
        self::NOT_SCALAR  => "The qualification must be a scalar value",
        self::QUALIFICATION_EXISTS  => "Qualification already exists"        
    );
    
    /**
     * Constructor.     
     */
    public function __construct($options = null) 
    {
        // Set filter options (if provided).
        if(is_array($options)) {            
            if(isset($options['entityManager']))
                $this->options['entityManager'] = $options['entityManager'];
            if(isset($options['qualification']))
                $this->options['qualification'] = $options['qualification'];
        }
        
        // Call the parent class constructor
        parent::__construct($options);
    }
        
    /**
     * Check if user exists.
     */
    public function isValid($value) 
    {
        if(!is_scalar($value)) {
            $this->error(self::NOT_SCALAR);
            return false; 
        }
        
        // Get Doctrine entity manager.
        $entityManager = $this->options['entityManager'];
        
        $qualification = $entityManager->getRepository(Qualification::class)
                ->findOneByQualification($value);
        
        if($this->options['qualification']==null) {
            $isValid = ($qualification==null);
        } else {
            if($this->options['qualification']->getQualification()!=$value && $qualification!=null) 
                $isValid = false;
            else 
                $isValid = true;
        }
        
        // If there were an error, set error message.
        if(!$isValid) {            
            $this->error(self::QUALIFICATION_EXISTS);            
        }
        
        // Return validation result.
        return $isValid;
    }
}