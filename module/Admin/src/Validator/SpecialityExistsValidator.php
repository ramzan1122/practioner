<?php
namespace Admin\Validator;
use Zend\Validator\AbstractValidator;
use Admin\Entity\Specialities;
/**
 * This validator class is designed for checking if there is an existing user 
 * with such an email.
 */
class SpecialityExistsValidator extends AbstractValidator 
{
    /**
     * Available validator options.
     * @var array
     */
    protected $options = array(
        'entityManager' => null,
        'speciality' => null
    );
    
    // Validation failure message IDs.
    const NOT_SCALAR  = 'notScalar';
    const SPECIALITY_EXISTS = 'specialityExists';
        
    /**
     * Validation failure messages.
     * @var array
     */
    protected $messageTemplates = array(
        self::NOT_SCALAR  => "The speciality must be a scalar value",
        self::SPECIALITY_EXISTS  => "Speciality already exists"        
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
            if(isset($options['speciality']))
                $this->options['speciality'] = $options['speciality'];
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
        
        $speciality = $entityManager->getRepository(Specialities::class)
                ->findOneBySpeciality($value);
        
        if($this->options['speciality']==null) {
            $isValid = ($speciality==null);
        } else {
            if($this->options['speciality']->getSpeciality()!=$value && $speciality!=null) 
                $isValid = false;
            else 
                $isValid = true;
        }
        
        // If there were an error, set error message.
        if(!$isValid) {            
            $this->error(self::SPECIALITY_EXISTS);            
        }
        
        // Return validation result.
        return $isValid;
    }
}