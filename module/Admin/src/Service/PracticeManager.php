<?php
namespace Admin\Service;
use Admin\Entity\Practice;

/**
 * This service is responsible for adding/editing Practitioner
 */
class PracticeManager
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
     * This method adds a new Practitioner.
     */
    public function addPractice($data)
    {
        

        // Create new Practitioner entity.
        $practice = new Practice();
        $practice->setPracticeName($data['practice_name']);
        $practice->setDescription($data['description']);
        $practice->setAddress($data['address']);
        $practice->setState($data['state']);
        $practice->setSuburb($data['suburb']);
        $practice->setPostalCode($data['postal_code']);
        $practice->setPhoneNumber($data['languages']);
        $practice->setLanguages($data['phone_number']);
        $practice->setLatitude($data['latitude']);
        $practice->setLongitude($data['longitude']);
        $practice->setDateCreated(date('Y-m-d H:i:s'));
        
        $this->entityManager->persist($practice);

        // Apply changes to database.
        $this->entityManager->flush();

        return $practice;
    }

    /**
     * This method updates data of an existing practitioner.
     */
    public function updatePractice($practice, $data)
    {

        $practice->setPracticeName($data['practice_name']);
        $practice->setDescription($data['description']);
        $practice->setAddress($data['address']);
        $practice->setState($data['state']);
        $practice->setSuburb($data['suburb']);
        $practice->setPostalCode($data['postal_code']);
        $practice->setPhoneNumber($data['languages']);
        $practice->setLanguages($data['phone_number']);
        $practice->setLatitude($data['latitude']);
        $practice->setLongitude($data['longitude']);

        // Apply changes to database.
        $this->entityManager->flush();
        return true;
    }
    

    public function deletePractice($id) {
        $this->entityManager->remove($id);
        $this->entityManager->flush();
    }

}