<?php
namespace Admin\Service;
use Admin\Entity\Specialities;

/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class SpecialitiesManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;  
    
    /**
     * Constructs the service.
     */
    public function __construct($entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * This method adds a new user.
     */
    public function addSpeciality($data) 
    {
        // Do not allow several users with the same email address.
        if($this->checkSpecialityExists($data['speciality'])) {
            throw new \Exception("This speciality already exists in database");
        }
        
        // Create new User entity.
        $speciality = new Specialities();
        $speciality->setSpeciality($data['speciality']);
        
        $currentDate = date('Y-m-d H:i:s');
        $speciality->setDateCreated($currentDate);        
                
        // Add the entity to the entity manager.
        $this->entityManager->persist($speciality);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $speciality;
    }
    
    /**
     * This method updates data of an existing user.
     */
    public function updateSpeciality($qualification, $data) 
    {
        // Do not allow to change user email if another user with such email already exits.
        if($qualification->getSpeciality()!=$data['speciality'] && 
                $this->checkSpecialityExists($data['speciality'])) {
            throw new \Exception("This speciality already exists in database");
        }
        
        $qualification->setSpeciality($data['speciality']);
             
        
        // Apply changes to database.
        $this->entityManager->flush();
        return true;
    }
    
   
    
    /**
     * Checks whether an active user with given email address already exists in the database.     
     */
    public function checkSpecialityExists($speciality) {
        
        $spec = $this->entityManager->getRepository(Specialities::class)
                ->findOneBySpeciality($speciality);
        
        return $spec !== null;
    }
    
    
}