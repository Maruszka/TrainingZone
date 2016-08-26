<?php
// src/AppBundle/Entity/User.php

namespace TrainingZoneBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    /**
     * @ORM\Column(name="firstName", type="string", nullable = true)
     */
    protected $firstName;
    
    /**
     * @ORM\Column(name="lastName", type="string", nullable = true)
     */
    protected $lastName;
    
    /**
     * @ORM\Column(name="phone", type="string" , nullable = true)
     */
    protected $phone;
    
    /**
     * @ORM\Column(name="pesel", type="string", nullable = true)
     */
    protected $pesel;
    
    /**
     * @ORM\Column(name="dateOfBirth", type="string", nullable = true)
     */
    protected $dateOfBirth;
    
    /**
     * @ORM\ ManyToMany(targetEntity="Training", mappedBy="users")
     */
    protected $trainings;

    //function toString - allow to display object using echo
    public function __toString() {
        return $this->firstName . " " . $this->lastName;
    } 
    

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set pesel
     *
     * @param string $pesel
     * @return User
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get pesel
     *
     * @return string 
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * Set dateOfBirth
     *
     * @param string $dateOfBirth
     * @return User
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return string 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Add trainings
     *
     * @param \TrainingZoneBundle\Entity\Training $trainings
     * @return User
     */
    public function addTraining(\TrainingZoneBundle\Entity\Training $trainings)
    {
        $this->trainings[] = $trainings;

        return $this;
    }

    /**
     * Remove trainings
     *
     * @param \TrainingZoneBundle\Entity\Training $trainings
     */
    public function removeTraining(\TrainingZoneBundle\Entity\Training $trainings)
    {
        $this->trainings->removeElement($trainings);
    }

    /**
     * Get trainings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrainings()
    {
        return $this->trainings;
    }
}
