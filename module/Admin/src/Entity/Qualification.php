<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a practioner Qualification.
 * @ORM\Entity(repositoryClass="\Admin\Repository\QualificationRepository")
 * @ORM\Table(name="qualifications")
 */
class Qualification 
{
    
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="qualification")  
     */
    protected $qualification;
    
   
    
    /**
     * @ORM\Column(name="date_created")  
     */
    protected $dateCreated;
        
    
    
    /**
     * Returns user ID.
     * @return integer
     */
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Sets user ID. 
     * @param int $id    
     */
    public function setId($id) 
    {
        $this->id = $id;
    }

    /**
     * Returns email.     
     * @return string
     */
    public function getQualification() 
    {
        return $this->qualification;
    }

    /**
     * Sets Qualification.     
     * @param integer $qualification
     */
    public function setQualification($qualification) 
    {
        $this->qualification = $qualification;
    }
    
    
    /**
     * Returns the date of user creation.
     * @return string     
     */
    public function getDateCreated() 
    {
        return $this->dateCreated;
    }
    
    /**
     * Sets the date when this user was created.
     * @param string $dateCreated     
     */
    public function setDateCreated($dateCreated) 
    {
        $this->dateCreated = $dateCreated;
    }    
    
    
}