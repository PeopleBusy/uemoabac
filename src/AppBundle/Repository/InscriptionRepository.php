<?php

namespace AppBundle\Repository;

/**
 * InscriptionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InscriptionRepository extends \Doctrine\ORM\EntityRepository
{
    public function findNbInscritptions($annee, $pays){

        $qb = $this->createQueryBuilder('i');
        $qb->select('COUNT(i)')
            ->where('i.annee = :annee')
            ->andWhere('i.pays = :pays')
            ->setParameter('annee', $annee)
            ->setParameter('pays', $pays);

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();

    }

    public function findNbAjournes($annee, $pays){

        $qb = $this->createQueryBuilder('i');
        $qb->select('COUNT(i)')
            ->where('i.annee = :annee')
            ->andWhere('i.pays = :pays')
            ->andWhere('i.ajourne = 1')
            ->setParameter('annee', $annee)
            ->setParameter('pays', $pays);

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();

    }

    public function findReinscriptions($annee, $pays){

        $qb = $this->createQueryBuilder('i');
        $qb->select('SUM(e.nbReinscription)')
            ->join('i.eleve', 'e')
            ->where('i.annee = :annee')
            ->andWhere('i.pays = :pays')
            //->andWhere('i.eleve.id > 0')
            ->setParameter('annee', $annee)
            ->setParameter('pays', $pays);

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();

    }

    public function findInscriptionsByAnneeAndPays($annee, $pays){

        $qb = $this->createQueryBuilder('i');
        $qb->select('i')
            ->where('i.annee = :annee')
            ->andWhere('i.pays = :pays')
            ->setParameter('annee', $annee)
            ->setParameter('pays', $pays);

        $query = $qb->getQuery();

        return $query->getResult();

    }

    public function checkIfMatriculeExistsInYearAndCountry($matricule, $annee, $pays){

        $qb = $this->createQueryBuilder('i');
        $qb->select('i')
            ->join('i.eleve', 'e')
            ->where('i.annee = :annee')
            ->andWhere('i.pays = :pays')
            ->andWhere('e.matricule = :matricule')
            ->setParameter('matricule', $matricule)
            ->setParameter('annee', $annee)
            ->setParameter('pays', $pays);

        $query = $qb->getQuery();

        return $query->getResult();

    }

    public function findEleveInscriptionFromYear($eleveId, $annee){

        $qb = $this->createQueryBuilder('i');
        $qb->select('i')
            ->join('i.eleve', 'e')
            ->where('e.id = :eleveId')
            ->andWhere('i.annee = :annee')
            ->setParameter('eleveId', $eleveId)
            ->setParameter('annee', $annee);

        $query = $qb->getQuery();

        return $query->getResult();

    }

    public function checkIfInscritExistsInYear($nom, $prenom, $datenaiss, $lieunaiss, $sexe, $annee){

        $qb = $this->createQueryBuilder('i');
        $qb->select('i')
            ->join('i.eleve', 'e')
            ->where('i.annee = :annee')
            ->andWhere('e.datenaiss = :datenaiss')
            ->andWhere('e.sexe = :sexe')
            ->andWhere($qb->expr()->andX(
                $qb->expr()->like('LOWER(e.nom)', '?1'),
                $qb->expr()->like('LOWER(e.prenom)', '?2'),
                $qb->expr()->like('LOWER(e.lieunaiss)', '?3')
            ))

            ->setParameter('annee', $annee)
            ->setParameter('datenaiss', $datenaiss)
            ->setParameter('sexe', $sexe)
            ->setParameter('1', '%' . strtolower($nom) . '%')
            ->setParameter('2', '%' . strtolower($prenom) . '%')
            ->setParameter('3', '%' . strtolower($lieunaiss) . '%');

        $query = $qb->getQuery();

        return $query->getResult();

    }

    public function findInscriptionsByStatus($ajourne, $pays){

        $qb = $this->createQueryBuilder('i');
        $qb->select('i')
            ->where('i.ajourne = :ajourne')
            ->andWhere('i.pays = :pays')
            ->setParameter('ajourne', $ajourne)
            ->setParameter('pays', $pays);

        $query = $qb->getQuery();

        return $query->getResult();

    }

    public function findByDistinctInscriptionYear(){

        $qb = $this->createQueryBuilder('i');
        $qb->select('i.annee')->distinct(true)
            ->orderBy('i.annee DESC');

        $query = $qb->getQuery();

        return $query->getResult();

    }

}
