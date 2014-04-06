<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection,

    Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\OneToMany(targetEntity="PhoneNumber", mappedBy="user", cascade={"remove"})
     */
    public $phones;

    /**
     * @ORM\OneToOne(targetEntity="Admin\Entity\Admin")
     * @ORM\JoinColumn(name="registeredBy_id", referencedColumnName="id", onDelete="SET NULL")
     */
    public $registeredBy;

    /** @ORM\Column(type="string") */
    public $name;

    /** @ORM\Column(type="string") */
    public $email;

    /** @ORM\Column(type="string") */
    public $role;

    /** @ORM\Column(type="bigint") */
    public $registerNumber;

    /** @ORM\Column(type="string") */
    public $company;

    /** @ORM\Column(type="datetime") */
    public $dateRegistered;

    /** @ORM\Column(type="datetime", nullable=true) */
    public $dateUpdated;

    public function __construct()
    {

        $this->phones = new ArrayCollection();
        $this->registeredBy = null;
        $this->name = '';
        $this->email = '';
        $this->role = 'user';
        $this->registerNumber = 0;
        $this->company = '';
        $this->dateRegistered = new \Datetime('now');
        $this->dateUpdated = null;

    }

    /**
     * Getter for id
     *
     * @return mixed
     */
    public function getId()
    {
    
        return $this->id;
    
    }

    /**
     * Getter for phones
     *
     * @return mixed
     */
    public function getPhones()
    {
    
        return $this->phones;
    
    }
    
    /**
     * Setter for phones
     *
     * @param mixed $phones Value to set
     *
     * @return self
     */
    public function setPhones($phones)
    {
    
        $this->phones = $phones;
    
        return $this;
    
    }
    
    /**
     * Getter for registeredBy
     *
     * @return mixed
     */
    public function getRegisteredBy()
    {
    
        return $this->registeredBy;
    
    }
    
    /**
     * Setter for registeredBy
     *
     * @param mixed $registeredBy Value to set
     *
     * @return self
     */
    public function setRegisteredBy($registeredBy)
    {
    
        $this->registeredBy = $registeredBy;
    
        return $this;
    
    }

    /**
     * Getter for name
     *
     * @return mixed
     */
    public function getName()
    {
    
        return $this->name;
    
    }
    
    /**
     * Setter for name
     *
     * @param mixed $name Value to set
     *
     * @return self
     */
    public function setName($name)
    {
    
        $this->name = $name;
    
        return $this;
    
    }

    /**
     * Getter for email
     *
     * @return mixed
     */
    public function getEmail()
    {
    
        return $this->email;
    
    }
    
    /**
     * Setter for email
     *
     * @param mixed $email Value to set
     *
     * @return self
     */
    public function setEmail($email)
    {
    
        $this->email = $email;
    
        return $this;
    
    }

    /**
     * Getter for role
     *
     * @return mixed
     */
    public function getRole()
    {
    
        return $this->role;
    
    }
    
    /**
     * Setter for role
     *
     * @param mixed $role Value to set
     *
     * @return self
     */
    public function setRole($role)
    {
    
        $this->role = $role;
    
        return $this;
    
    }
    
    /**
     * Getter for registerNumber
     *
     * @return mixed
     */
    public function getRegisterNumber()
    {
    
        return $this->registerNumber;
    
    }
    
    /**
     * Setter for registerNumber
     *
     * @param mixed $registerNumber Value to set
     *
     * @return self
     */
    public function setRegisterNumber($registerNumber)
    {
    
        $this->registerNumber = $registerNumber;
    
        return $this;
    
    }
    
    /**
     * Getter for company
     *
     * @return mixed
     */
    public function getCompany()
    {
    
        return $this->company;
    
    }
    
    /**
     * Setter for company
     *
     * @param mixed $company Value to set
     *
     * @return self
     */
    public function setCompany($company)
    {
    
        $this->company = $company;
    
        return $this;
    
    }

    /**
     * Getter for dateRegistered
     *
     * @return mixed
     */
    public function getDateRegistered()
    {
    
        return $this->dateRegistered;
    
    }
    
    /**
     * Setter for dateRegistered
     *
     * @param mixed $dateRegistered Value to set
     *
     * @return self
     */
    public function setDateRegistered($dateRegistered)
    {
    
        $this->dateRegistered = $dateRegistered;
    
        return $this;
    
    }

    /**
     * Getter for dateUpdated
     *
     * @return mixed
     */
    public function getDateUpdated()
    {
    
        return $this->dateUpdated;
    
    }
    
    /**
     * Setter for dateUpdated
     *
     * @param mixed $dateUpdated Value to set
     *
     * @return self
     */
    public function setDateUpdated($dateUpdated)
    {
    
        $this->dateUpdated = $dateUpdated;
    
        return $this;
    
    }

}
