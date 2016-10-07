<?php
namespace Summoner\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="postal_code_city")
 */
class PostalCodeCity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** @ORM\Column(name="country_code", type="string")
     * @Assert\Length(
     *     min = 2,
     *     max = 2
     * )
     */
    protected $countryCode;

    /** @ORM\Column(name="postal_code", type="string")
     * @Assert\Length(
     *    max = 5
     * )
     */
    protected $postalCode;

    /** @ORM\Column(name="city", type="string") */
    protected $city;

    public function getId()
    {
        return $this->id;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getPostalCode()
    {
        return $this->postalCode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }
}
