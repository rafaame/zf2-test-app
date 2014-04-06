<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity
 * @ORM\Table(name="phone_number")
 */
class PhoneNumber
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="phones")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    public $user;

    /** @ORM\Column(type="smallint") */
    public $countryCode;
	
	/** @ORM\Column(type="smallint") */
    public $areaCode;
	
	/** @ORM\Column(type="bigint") */
    public $number;

    /** @ORM\Column(type="boolean") */
    public $mobile;

    public function __construct()
    {

    	$this->customer = null;

    	//Brazil country code
        $this->countryCode = 55;
        
        $this->areaCode = 0;
        $this->number = 0;
        $this->mobile = false;
    }
	
	public function getId()
    {

    	return $this->id;

    }

    /**
     * @return Application\Entity\Customer
     */
    public function getCustomer()
    {

    	return $this->customer;

    }

    public function setCustomer($value)
    {

    	$this->customer = $value;

    	return $this;

    }
	
	public function getCountryCode()
	{
		
		return $this->countryCode;
		
	}

	public function setCountryCode($value)
	{

		$this->countryCode = $value;

		return $this;

	}
	
	public function getAreaCode()
	{
		
		return $this->areaCode;
		
	}

	public function setAreaCode($value)
	{

		$this->areaCode = $value;

		return $this;

	}
	
	public function getNumber()
	{
		
		return $this->number;
		
	}

	public function setNumber($value)
	{

		$this->number = $value;

		return $this;

	}

	public function getMobile()
	{

		return $this->mobile;

	}

	public function setMobile($value)
	{

		$this->mobile = $value;

		return $this;

	}

	public function format($format = '+CC (AC) N')
	{

		$format = str_replace('CC', $this->getCountryCode(), $format);
		$format = str_replace('AC', $this->getAreaCode(), $format);
		$format = str_replace('N', $this->getNumber(), $format);
		
		return $format;

	}

}
