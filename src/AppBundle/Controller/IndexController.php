<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \DateTime;

class IndexController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/home",name="bac_homepage")
     */
    public function indexAction()
    {

        $inscriptionRepository = $this->getDoctrine()
            ->getRepository('AppBundle:Inscription');

        $annee = (new DateTime)->format("Y");

        $nbInscrits = $inscriptionRepository->findNbInscritptions($annee, $this->getUser()->getPays());

        $nbAjournes = $inscriptionRepository->findNbAjournes($annee, $this->getUser()->getPays());

        $nbReinscriptions = $inscriptionRepository->findReinscriptions($annee, $this->getUser()->getPays());

        return $this->render('AppBundle:Default:index.html.twig', array('nbInscrits' => $nbInscrits,
            'nbAjournes' => $nbAjournes, 'nbReinscriptions' => $nbReinscriptions));

    }
}
