<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Address {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $id;

	/** @ORM\Column(type="string") */
	protected $city;
	
	/** @ORM\Column(type="string") */
	protected $country;
	
	public function getId()
	{
		return $this->id;
	}

    public function getCity()
    {
        return $this->city;
    }
    
    public function getCountry()
    {
    	return $this->country;
    }
    
    public function setCity($value)
    {
        $this->city = $value;
    }
    
    public function setCountry($value)
    {
        $this->country = $value;
    }
}