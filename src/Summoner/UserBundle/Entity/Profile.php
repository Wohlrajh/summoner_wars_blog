<?php
namespace Summoner\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="profile")
 */
class Profile
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="profile")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", unique=true, nullable=false)
     */
    protected $user;

    /** @ORM\Column(name="civility", type="string", nullable = true) */
    protected $civility;

    /** @ORM\Column(name="name", type="string", nullable = true) */
    protected $lastName;

    /** @ORM\Column(name="firstname", type="string", nullable = true) */
    protected $firstName;

    /** @ORM\Column(name="date_of_birth", type="date", nullable = true) */
    protected $dateOfBirth;

    /** @ORM\Column(name="postal_code", type="string", nullable = true) */
    protected $postalCode;

    /** @ORM\Column(name="country", type="string", nullable = true) */
    protected $country;

    /** @ORM\Column(name="addr1", type="string", nullable = true) */
    protected $address1;

    /** @ORM\Column(name="addr2", type="string", nullable = true) */
    protected $address2;

    /** @ORM\Column(name="date_update", type="datetimetz", nullable = true) */
    protected $dateUpdate;

    /** @ORM\Column(name="city", type="string", nullable = true) */
    protected $city;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \Summoner\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    public function getCivility()
    {
        return $this->civility;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getAddress1()
    {
        return $this->address1;
    }

    public function getAddress2()
    {
        return $this->address2;
    }

    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param User $user
     * @throws \InvalidArgumentException
     * @return \Summoner\UserBundle\Entity\Profile
     */
    public function setIdentity(User $user)
    {
        if (null !== $this->id) {
            throw new \InvalidArgumentException('Once this object is saved, you are not allowed to change the identity relation.');
        }
        $this->user = $user;

        return $this;
    }

    public function setCivility($civility)
    {
        $this->civility = $civility;
        return $this;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
        return $this;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function setAddress1($address1)
    {
        $this->address1 = $address1;
        return $this;
    }

    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        return $this;
    }

    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }
}
