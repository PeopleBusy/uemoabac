<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InscriptionAutorise
 *
 * @ORM\Table(name="inscription_autorise")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InscriptionAutoriseRepository")
 */
class InscriptionAutorise
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

