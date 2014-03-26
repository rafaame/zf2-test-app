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

}
