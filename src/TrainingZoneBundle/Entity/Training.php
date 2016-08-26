<?php

namespace TrainingZoneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Training
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TrainingZoneBundle\Entity\TrainingRepository")
 */
class Training {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="max", type="integer")
     */
    private $max;

    /**
     * @var integer
     *
     * @ORM\Column(name="min", type="integer")
     */
    private $min;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     *
     * @ORM\OneToOne(targetEntity="Status", inversedBy="training")
     * @ORM\JoinColumn()
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="trainings")
     * @ORM\JoinTable()
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="trainings")
     * @ORM\JoinTable()
     */
    private $users;

    public function __construct() {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->status = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return $this->date;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Training
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Training
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Training
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set max
     *
     * @param integer $max
     * @return Training
     */
    public function setMax($max) {
        $this->max = $max;

        return $this;
    }

    /**
     * Get max
     *
     * @return integer 
     */
    public function getMax() {
        return $this->max;
    }

    /**
     * Set min
     *
     * @param integer $min
     * @return Training
     */
    public function setMin($min) {
        $this->min = $min;

        return $this;
    }

    /**
     * Get min
     *
     * @return integer 
     */
    public function getMin() {
        return $this->min;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Training
     */
    public function setPlace($place) {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace() {
        return $this->place;
    }

    /**
     * Set status
     *
     * @param \TrainingZoneBundle\Entity\Status $status
     * @return Training
     */
    public function setStatus(\TrainingZoneBundle\Entity\Status $status = null) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \TrainingZoneBundle\Entity\Status 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Add categories
     *
     * @param \TrainingZoneBundle\Entity\Category $categories
     * @return Training
     */
    public function addCategory(\TrainingZoneBundle\Entity\Category $categories) {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \TrainingZoneBundle\Entity\Category $categories
     */
    public function removeCategory(\TrainingZoneBundle\Entity\Category $categories) {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * Add users
     *
     * @param \TrainingZoneBundle\Entity\User $users
     * @return Training
     */
    public function addUser(\TrainingZoneBundle\Entity\User $users) {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \TrainingZoneBundle\Entity\User $users
     */
    public function removeUser(\TrainingZoneBundle\Entity\User $users) {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers() {
        return $this->users;
    }

}
