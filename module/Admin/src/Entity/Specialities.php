<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a practioner Specialities.
 * @ORM\Entity(repositoryClass="\Admin\Repository\SpecialitiesRepository")
 * @ORM\Table(name="specialities")
 */
class Specialities 
{
    
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="speciality")  
     */
    protected $speciality;
    
   
    
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
    public function getSpeciality() 
    {
        return $this->speciality;
    }

    /**
     * Sets Qualification.     
     * @param integer $speciality
     */
    public function setSpeciality($speciality) 
    {
        $this->speciality = $speciality;
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