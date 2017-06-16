<?php
namespace Admin\Service;
use Admin\Entity\Qualification;

/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class QualificationManager
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
    public function addQualification($data) 
    {
        // Do not allow several users with the same email address.
        if($this->checkQualificationExists($data['qualification'])) {
            throw new \Exception("This qualification alread exists in database");
        }
        
        // Create new User entity.
        $qualification = new Qualification();
        $qualification->setQualification($data['qualification']);
        
        $currentDate = date('Y-m-d H:i:s');
        $qualification->setDateCreated($currentDate);        
                
        // Add the entity to the entity manager.
        $this->entityManager->persist($qualification);
        
        // Apply changes to database.
        $this->entityManager->flush();
        
        return $qualification;
    }
    
    /**
     * This method updates data of an existing user.
     */
    public function updateQualification($qualification, $data) 
    {
        // Do not allow to change user email if another user with such email already exits.
        if($qualification->getQualification()!=$data['qualification'] && 
                $this->checkQualificationExists($data['qualification'])) {
            throw new \Exception("This qualification alread exists in database");
        }
        
        $qualification->setQualification($data['qualification']);
             
        
        // Apply changes to database.
        $this->entityManager->flush();
        return true;
    }
    
   
    
    /**
     * Checks whether an active user with given email address already exists in the database.     
     */
    public function checkQualificationExists($qualification) {
        
        $qua = $this->entityManager->getRepository(Qualification::class)
                ->findOneByQualification($qualification);
        
        return $qua !== null;
    }
    
    
}