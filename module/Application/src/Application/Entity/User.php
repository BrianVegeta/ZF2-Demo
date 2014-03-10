<?php
namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/** @ORM\Entity */
class User {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	protected $id;

	/** @ORM\Column(type="string") */
	protected $fullName;
	
	/**
	 * ASSOCIATIONS
	 */
	protected $address;
	protected $projects;
	
	
	public function __construct()
	{
	    $this->projects = new ArrayCollection();
	}
	
	public function getId()
	{
		return $this->id;
	}

    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName($value)
    {
        $this->fullName = $value;
    }
}