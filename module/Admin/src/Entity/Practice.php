<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a practice.
 * @ORM\Entity(repositoryClass="\Admin\Repository\PracticeRepository")
 * @ORM\Table(name="practice")
 */
class Practice 
{
    
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

   
    /** 
     * @ORM\Column(name="practice_name")  
     */
    protected $practiceName;
    
    /** 
     * @ORM\Column(name="description")  
     */
    protected $description;
    
     /** 
     * @ORM\Column(name="address")  
     */       
    protected $address;
    
    /** 
     * @ORM\Column(name="state")  
     */       
    protected $state;
    
    /** 
     * @ORM\Column(name="suburb")  
     */       
    protected $suburb;
    
    /** 
     * @ORM\Column(name="postal_code")  
     */       
    protected $postalCode;
    
     /** 
     * @ORM\Column(name="phone_number")  
     */       
    protected $phoneNumber;
    /** 
     * @ORM\Column(name="languages")  
     */        
    protected $languages;
    /** 
     * @ORM\Column(name="latitude")  
     */        
    protected $latitude;
    /** 
     * @ORM\Column(name="longitude")  
     */        
    protected $longitude;
    
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
     * Returns practiceNamee.     
     * @return string
     */
    public function getPracticeName() 
    {
        return $this->practiceName;
    }

    /**
     * Sets practice name.     
     * @param string $practiceName
     */
    public function setPracticeName($practiceName) 
    {
        $this->practiceName = $practiceName;
    }
    
    /**
     * Returns description.     
     * @return string
     */
    public function getDescription() 
    {
        return $this->description;
    }

    /**
     * Sets practice name.     
     * @param string $description
     */
    public function setDescription($description) 
    {
        $this->description = $description;
    }
    
    /**
     * Returns description.     
     * @return string
     */
    public function getAddress() 
    {
        return $this->address;
    }

    /**
     * Sets address.     
     * @param string $address
     */
    public function setAddress($address) 
    {
        $this->address = $address;
    }
    
    
    public function getState() 
    {
        return $this->state;
    }
    /**
     * Sets state.     
     * @param string $state
     */
    public function setState($state) 
    {
        $this->state = $state;
    }
    
    
    public function getSuburb() 
    {
        return $this->suburb;
    }
    /**
     * Sets state.     
     * @param string $suburb
     */
    public function setSuburb($suburb) 
    {
        $this->suburb = $suburb;
    }
    
    
    
    public function getPostalCode() 
    {
        return $this->postalCode;
    }
    /**
     * Sets state.     
     * @param string $postalCode
     */
    public function setPostalCode($postalCode) 
    {
        $this->postalCode = $postalCode;
    }
   
     /**
     * Returns phoneNumber.     
     * @return string
     */
    public function getPhoneNumber() 
    {
        return $this->phoneNumber;
    }

    /**
     * Sets address.     
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber) 
    {
        $this->phoneNumber = $phoneNumber;
    }
    
     /**
     * Returns languages.     
     * @return string
     */
    public function getLanguages() 
    {
        return $this->languages;
    }

    /**
     * Sets language.     
     * @param string $languages
     */
    public function setLanguages($languages) 
    {
        $this->languages = $languages;
    }
    
    /**
     * Returns latitude.     
     * @return decimal
     */
    public function getLatitude() 
    {
        return $this->latitude;
    }

    /**
     * Sets latitude.     
     * @param decimal $latitude
     */
    public function setLatitude($latitude) 
    {
        $this->latitude = $latitude;
    }
    
    /**
     * Returns longitude.     
     * @return decimal
     */
    public function getLongitude() 
    {
        return $this->longitude;
    }

    /**
     * Sets longitude.     
     * @param decimal $longitude
     */
    public function setLongitude($longitude) 
    {
        $this->longitude = $longitude;
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