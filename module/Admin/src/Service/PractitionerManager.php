<?php
namespace Admin\Service;
use Admin\Entity\Practitioner;
use Zend\Math\Rand;
/**
 * This service is responsible for adding/editing Practitioner
 */
class PractitionerManager
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
    public function addPractitioner($data)
    {
        // Do not allow several users with the same email address.
        if($this->checkPractitionerExists($data['email'])) {
            throw new \Exception("Practitioner with email address " . $data['$email'] . " already exists");
        }

        // Create new Practitioner entity.
        $practitioner = new Practitioner();
        $practitioner->setEmail($data['email']);
        $practitioner->setFirstName($data['first_name']);
        $practitioner->setLastName($data['last_name']);
        $practitioner->setLanguage($data['language']);
        $practitioner->setPhoneNumber($data['phone_number']);
        $practitioner->setGender($data['gender']);
        $practitioner->setAddress($data['address']);
        $practitioner->setOverview($data['overview']);
        $practitioner->setQualification($data['qualification']);
        //$practitioner->setAvatar($data['avatar']);
/*        $currentDate = date('Y-m-d H:i:s');
        $user->getDateAdded($currentDate);*/

        // Add the entity to the entity manager.
        $this->entityManager->persist($practitioner);

        // Apply changes to database.
        $this->entityManager->flush();

        return $practitioner;
    }

    /**
     * This method updates data of an existing practitioner.
     */
    public function updatePractitioner($practitioner, $data)
    {
        // Do not allow to change practitioner email if another practitioner with such email already exits.
        if($practitioner->getEmail()!=$data['email'] && $this->checkPractitionerExists($data['email'])) {
            throw new \Exception("Another practitioner with email address " . $data['email'] . " already exists");
        }

        $practitioner->setEmail($data['email']);
        $practitioner->setFirstName($data['first_name']);
        $practitioner->setLastName($data['last_name']);
        $practitioner->setLanguage($data['language']);
        $practitioner->setPhoneNumber($data['phone_number']);
        $practitioner->setGender($data['gender']);
        $practitioner->setAddress($data['address']);
        $practitioner->setOverview($data['overview']);
        $practitioner->setQualification($data['qualification']);

        // Apply changes to database.
        $this->entityManager->flush();
        return true;
    }
    /**
     * Checks whether an active Practitioner with given email address already exists in the database.
     */
    public function checkPractitionerExists($email) {

        $practitioner = $this->entityManager->getRepository(Practitioner::class)
                ->findOneByEmail($email);

        return $practitioner !== null;
    }

    public function deletePractitioner($id) {
        $this->entityManager->remove($id);
        $this->entityManager->flush();
    }

}