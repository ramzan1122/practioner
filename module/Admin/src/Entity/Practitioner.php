<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered practitioners.
 * @ORM\Entity(repositoryClass="\Admin\Repository\PractitionerRepository")
 * @ORM\Table(name="practitioners")
 */
class Practitioner
{
    // practitioners status constants.
    const STATUS_ACTIVE       = 1; // Active practitioners.
    const STATUS_RETIRED      = 2; // Retired practitioners.

    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(name="email")
     */
    protected $email;

    /**
     * @ORM\Column(name="first_name")
     */
    protected $firstName;

    /**
     * @ORM\Column(name="last_name")
     */
    protected $lastName;

    /**
     * @ORM\Column(name="language")
     */
    protected $language;

    /**
     * @ORM\Column(name="phone_number")
     */
    protected $phoneNumber;

    /**
     * @ORM\Column(name="gender")
     */
    protected $gender;

    /**
     * @ORM\Column(name="address")
     */
    protected $address;

    /**
     * @ORM\Column(name="overview")
     */
    protected $overview;

    /**
     * @ORM\Column(name="qualification")
     */
    protected $qualification;

    /**
     * @ORM\Column(name="avatar")
     */
    protected $avatar;

    /**
     * @ORM\Column(name="date_created")
     */
    protected $dateCreated;

    /**
     * Returns practitioners ID.
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets practitioners ID.
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets email.
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Returns first name.
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Sets first name.
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Returns lastName.
     * @param string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Sets last names.
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }


    /**
     * Returns language.
     * @param string $language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Sets language.
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }


    /**
     * Returns phoneNumber.
     * @param string $phoneNumber
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Sets phoneNumber.
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
    /**
     * Returns gender.
     * @param string $gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Sets gender.
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }


    /**
     * Returns address.
     * @param string $address
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


    /**
     * Returns overview.
     * @param string $overview
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * Sets overview.
     * @param string $overview
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;
    }

    /**
     * Returns qualification.
     * @param string $qualification
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * Sets qualification.
     * @param string $qualification
     */
    public function setQualification($qualification)
    {
        $this->qualification = $qualification;
    }

    /**
     * Returns avatar.
     * @param string $avatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Sets avatar.
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }


    /**
     * Returns date_created.
     * @param string $date_created
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Sets date_created.
     * @param string $date_created
     */
    public function setDateCreated($date_created)
    {
        $this->dateCreated = $dateCreated;
    }
    /*........................*/
}