<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operation
 *
 * @ORM\Table(name="operation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OperationRepository")
 */
class Operation
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
     * @ORM\Column(name="libelle", type="string", length=30)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_heure", type="datetime")
     */
    private $dateHeure;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=60)
     */
    private $auteur;

    /**
     * @var int
     *
     * @ORM\Column(name="type_operation", type="smallint")
     */
    private $typeOperation;

    /**
     * @ORM\ManyToOne(targetEntity="Inscription", inversedBy="operations")
     * @ORM\JoinColumn(name="inscription_id", referencedColumnName="id", nullable=true)
     */
    private $inscription;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Operation
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set dateHeure
     *
     * @param \DateTime $dateHeure
     *
     * @return Operation
     */
    public function setDateHeure($dateHeure)
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    /**
     * Get dateHeure
     *
     * @return \DateTime
     */
    public function getDateHeure()
    {
        return $this->dateHeure;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Operation
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set typeOperation
     *
     * @param integer $typeOperation
     *
     * @return Operation
     */
    public function setTypeOperation($typeOperation)
    {
        $this->typeOperation = $typeOperation;

        return $this;
    }

    /**
     * Get typeOperation
     *
     * @return int
     */
    public function getTypeOperation()
    {
        return $this->typeOperation;
    }


    /**
     * Set inscription
     *
     * @param \AppBundle\Entity\Inscription $inscription
     *
     * @return Operation
     */
    public function setInscription(\AppBundle\Entity\Inscription $inscription = null)
    {
        $this->inscription = $inscription;

        return $this;
    }

    /**
     * Get inscription
     *
     * @return \AppBundle\Entity\Inscription
     */
    public function getInscription()
    {
        return $this->inscription;
    }
}
