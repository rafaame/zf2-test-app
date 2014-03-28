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

    /** @ORM\Column(type="string") */
    public $name;

    /** @ORM\Column(type="string") */
    public $email;

    /** @ORM\Column(type="datetime") */
    public $dateRegistered;

    public function __construct()
    {

        $this->name = '';
        $this->email = '';
        $this->dateRegistered = new \Datetime('now');

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

}
