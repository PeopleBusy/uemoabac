<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 *
 * @ORM\Table(name="inscription")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InscriptionRepository")
 */
class Inscription
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_inscription", type="date")
     */
    private $dateInscription;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="annee", type="string", length=255)
     */
    private $annee;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=10)
     */
    private $serie;

    /**
     * @var string
     *
     * @ORM\Column(name="etablissement", type="string", length=255)
     */
    private $etablissement;

    /**
     * @var bool
     *
     * @ORM\Column(name="ajourne", type="boolean")
     */
    private $ajourne;

    /**
     * @var string
     *
     * @ORM\Column(name="motif_ajournement", type="text")
     */
    private $motifAjournement;

    /**
     * @var int
     *
     * @ORM\Column(name="inscription_apres_nbannees", type="smallint")
     */
    private $inscriptionApresNbannees;

    /**
     * @var int
     *
     * @ORM\Column(name="fin_sanction", type="smallint", nullable=true)
     */
    private $finSanction;

    /**
     * @var string
     *
     * @ORM\Column(name="annee_fin_restriction", type="string", nullable=true)
     */
    private $anneeFinRestriction;

    /**
     * @ORM\ManyToOne(targetEntity="Eleve", inversedBy="inscriptions")
     * @ORM\JoinColumn(name="eleve_id", referencedColumnName="id", nullable=true)
     */
    private $eleve;

    /**
     * @ORM\OneToMany(targetEntity="Operation", mappedBy="inscription")
     */
    private $operations;


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
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return Inscription
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Inscription
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set annee
     *
     * @param string $annee
     *
     * @return Inscription
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
     * Set etablissement
     *
     * @param string $etablissement
     *
     * @return Inscription
     */
    public function setEtablissement($etablissement)
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * Get etablissement
     *
     * @return string
     */
    public function getEtablissement()
    {
        return $this->etablissement;
    }

    /**
     * Set ajourne
     *
     * @param boolean $ajourne
     *
     * @return Inscription
     */
    public function setAjourne($ajourne)
    {
        $this->ajourne = $ajourne;

        return $this;
    }

    /**
     * Get ajourne
     *
     * @return bool
     */
    public function getAjourne()
    {
        return $this->ajourne;
    }

    /**
     * Set motifAjournement
     *
     * @param string $motifAjournement
     *
     * @return Inscription
     */
    public function setMotifAjournement($motifAjournement)
    {
        $this->motifAjournement = $motifAjournement;

        return $this;
    }

    /**
     * Get motifAjournement
     *
     * @return string
     */
    public function getMotifAjournement()
    {
        return $this->motifAjournement;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->operations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set inscriptionApresNbannees
     *
     * @param integer $inscriptionApresNbannees
     *
     * @return Inscription
     */
    public function setInscriptionApresNbannees($inscriptionApresNbannees)
    {
        $this->inscriptionApresNbannees = $inscriptionApresNbannees;

        return $this;
    }

    /**
     * Get inscriptionApresNbannees
     *
     * @return integer
     */
    public function getInscriptionApresNbannees()
    {
        return $this->inscriptionApresNbannees;
    }

    /**
     * Add operation
     *
     * @param \AppBundle\Entity\Operation $operation
     *
     * @return Inscription
     */
    public function addOperation(\AppBundle\Entity\Operation $operation)
    {
        $this->operations[] = $operation;

        return $this;
    }

    /**
     * Remove operation
     *
     * @param \AppBundle\Entity\Operation $operation
     */
    public function removeOperation(\AppBundle\Entity\Operation $operation)
    {
        $this->operations->removeElement($operation);
    }

    /**
     * Get operations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * Set eleve
     *
     * @param \AppBundle\Entity\Eleve $eleve
     *
     * @return Inscription
     */
    public function setEleve(\AppBundle\Entity\Eleve $eleve = null)
    {
        $this->eleve = $eleve;

        return $this;
    }

    /**
     * Get eleve
     *
     * @return \AppBundle\Entity\Eleve
     */
    public function getEleve()
    {
        return $this->eleve;
    }


    /**
     * Set anneeFinRestriction
     *
     * @param string $anneeFinRestriction
     *
     * @return Inscription
     */
    public function setAnneeFinRestriction($anneeFinRestriction)
    {
        $this->anneeFinRestriction = $anneeFinRestriction;

        return $this;
    }

    /**
     * Get anneeFinRestriction
     *
     * @return string
     */
    public function getAnneeFinRestriction()
    {
        return $this->anneeFinRestriction;
    }
}
