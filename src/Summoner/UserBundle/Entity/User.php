<?php
namespace Summoner\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="identity")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Plain password. Used for model validation. Must not be persisted.
     *
     * @var string
     * @Assert\Regex(
     *  pattern="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,16}$/",
     *  message="The password must contain between 8 and 16 alphanumeric characters, one uppercase letter, one lowercase and one number."
     * )
     */
    protected $plainPassword;

    /**
     * @ORM\OneToOne(targetEntity="Profile", mappedBy="user", cascade={"remove", "merge", "detach", "refresh"})
     *
     * @var Profile
     */
    protected $profile;



    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Summoner\UserBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile = null)
    {
        if ($this->getId() !== null && $profile === null) {
            throw new \InvalidArgumentException('Can\'t unset profile once it is setted.');
        }

        $this->profile = $profile;
        return $this;
    }

    public function setCivility($civility)
    {
        $this->profile->setCivility($civility);
        return $this;
    }

    public function setLastName($lastName)
    {
        $this->profile->setLastName($lastName);
        return $this;
    }

    public function setFirstName($firstName)
    {
        $this->profile->setFirstName($firstName);
        return $this;
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->profile->setDateOfBirth($dateOfBirth);
        return $this;
    }

    public function setZipCode($zipCode)
    {
        $this->profile->setZipCode($zipCode);
        return $this;
    }

    public function setCountry($country)
    {
        $this->profile->setCountry($country);
        return $this;
    }

    public function setAddress1($address1)
    {
        $this->profile->setAddress1($address1);
        return $this;
    }

    public function setAddress2($address2)
    {
        $this->profile->setAddress2($address2);
        return $this;
    }

    public function setDateUpdate($dateUpdate)
    {
        $this->profile->setDateUpdate($dateUpdate);
        return $this;
    }

    public function setCity($city)
    {
        $this->profile->setCity($city);
        return $this;
    }

    public function getCivility()
    {
        return $this->profile->getCivility();
    }

    public function getLastName()
    {
        return $this->profile->getLastName();
    }

    public function getFirstName()
    {
        return $this->profile->getFirstName();
    }

    public function getDateOfBirth()
    {
        return $this->profile->getDateOfBirth();
    }

    public function getZipCode()
    {
        return $this->profile->getZipCode();
    }

    public function getCountry()
    {
        return $this->profile->getCountry();
    }

    public function getAddress1()
    {
        return $this->profile->getAddress1();
    }

    public function getAddress2()
    {
        return $this->profile->getAddress2();
    }

    public function getDateUpdate()
    {
        return $this->profile->getDateUpdate();
    }

    public function getCity()
    {
        return $this->profile->getCity();
    }
}
