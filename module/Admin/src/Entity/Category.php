<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered category.
 * @ORM\Entity()
 * @ORM\Table(name="category")
 */
class Category 
{
    // User status constants.
    const STATUS_ACTIVE       = 1; // Active category.
    const STATUS_RETIRED      = 2; // Retired category.
    
    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="title")  
     */
    protected $title;
    
    /** 
     * @ORM\Column(name="parent_id")  
     */
    protected $parentId;


    /** 
     * @ORM\Column(name="status")  
     */
    protected $status;
    
    /**
     * @ORM\Column(name="date_created")  
     */
    protected $dateCreated;

    /**
     * Returns category ID.
     * @return integer
     */
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Sets category ID. 
     * @param int $id    
     */
    public function setId($id) 
    {
        $this->id = $id;
    }

    /**
     * Returns title.     
     * @return string
     */
    public function getTitle() 
    {
        return $this->title;
    }

    /**
     * Sets title.     
     * @param string $title
     */
    public function setTitle($title) 
    {
        $this->title = $title;
    }
    
    /**
     * Returns full name.
     * @return string     
     */
    public function getParentId() 
    {
        return $this->parentId;
    }       

    /**
     * Sets full name.
     * @param string $fullName
     */
    public function setParentId($parentId) 
    {
        $this->parentId = $parentId;
    }
    
    /**
     * Returns status.
     * @return int     
     */
    public function getStatus() 
    {
        return $this->status;
    }

    /**
     * Returns possible statuses as array.
     * @return array
     */
    public static function getStatusList() 
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_RETIRED => 'Retired'
        ];
    }    
    
    /**
     * Returns category status as string.
     * @return string
     */
    public function getStatusAsString()
    {
        $list = self::getStatusList();
        if (isset($list[$this->status]))
            return $list[$this->status];
        
        return 'Unknown';
    }    
    
    /**
     * Sets status.
     * @param int $status     
     */
    public function setStatus($status) 
    {
        $this->status = $status;
    }   
    
    /**
     * Returns the date of category creation.
     * @return string     
     */
    public function getDateCreated() 
    {
        return $this->dateCreated;
    }
    
    /**
     * Sets the date when this category was created.
     * @param string $dateCreated     
     */
    public function setDateCreated($dateCreated) 
    {
        $this->dateCreated = $dateCreated;
    }    

}