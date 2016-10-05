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
}
