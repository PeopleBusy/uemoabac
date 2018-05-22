<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfigurationDate
 *
 * @ORM\Table(name="configuration_date")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConfigurationDateRepository")
 */
class ConfigurationDate
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="annee", type="string", length=4, unique=true)
     */
    private $annee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinInscription", type="datetime")
     */
    private $dateFinInscription;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set annee
     *
     * @param string $annee
     *
     * @return ConfigurationDate
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return string
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set dateFinInscription
     *
     * @param \DateTime $dateFinInscription
     *
     * @return ConfigurationDate
     */
    public function setDateFinInscription($dateFinInscription)
    {
        $this->dateFinInscription = $dateFinInscription;

        return $this;
    }

    /**
     * Get dateFinInscription
     *
     * @return \DateTime
     */
    public function getDateFinInscription()
    {
        return $this->dateFinInscription;
    }
}

