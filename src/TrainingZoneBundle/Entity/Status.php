<?php

namespace TrainingZoneBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Status
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="TrainingZoneBundle\Entity\StatusRepository")
 */
class Status {

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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     *
     * @ORM\OneToOne(targetEntity="Training", mappedBy="status")
     */
    private $training;

    public function __toString() {
        return $this->type;
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
     * Set type
     *
     * @param string $type
     * @return Status
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set training
     *
     * @param \TrainingZoneBundle\Entity\Training $training
     * @return Status
     */
    public function setTraining(\TrainingZoneBundle\Entity\Training $training = null) {
        $this->training = $training;

        return $this;
    }

    /**
     * Get training
     *
     * @return \TrainingZoneBundle\Entity\Training 
     */
    public function getTraining() {
        return $this->training;
    }

}
