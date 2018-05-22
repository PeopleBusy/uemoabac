<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Eleve;
use AppBundle\Entity\Inscription;
use AppBundle\Entity\Operation;
use AppBundle\Form\EleveType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \DateTime;

class InscriptionController extends Controller
{

    /**
     * @Route("/inscription/add",name="inscription_add")
     */
    public function addAction(Request $request)
    {

        $form = $this->createForm(EleveType::class, new Eleve(), array(
            'action' => $this->generateUrl('inscription_add'),
            'method' => 'POST',
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $eleve = $form->getData();

            $repository = $this->getDoctrine()
                ->getRepository('AppBundle:Inscription');

            $datenaiss = DateTime::createFromFormat('d/m/Y', $request->request->get('datenaiss'));


            $annee = (new DateTime)->format("Y");

            $inscription = $repository->checkIfMatriculeExistsInYearAndCountry($eleve->getMatricule(), $annee, $this->getUser()->getPays());

            if ($inscription != null)
                return $this->render('AppBundle:Default:inscription/new.html.twig', array('form' => $form->createView(),
                    'erreur' => 'Une inscription pour l\' année ' . $annee . ' a déjà été enrégistrée pour cet(te) étudiant(e) au ' . $this->getUser()->getPays(),
                    'eleve_inscriptions_in_current_year' => $inscription));


            $dtn = $datenaiss->format('Y-m-d');

            $inscription = $repository->checkIfInscritExistsInYear($eleve->getNom(), $eleve->getPrenom(), $dtn, $eleve->getLieunaiss(), $eleve->getSexe(), $annee);

            if ($inscription != null) {

                if ($inscription[0]->getEleve()->getAutoriseInscription() == 0) {

                    $eleve_inscriptions_in_current_year = $repository->findEleveInscriptionFromYear($inscription[0]->getEleve()->getId(), $annee);

                    return $this->render('AppBundle:Default:inscription/new.html.twig', array('form' => $form->createView(),
                        'erreur' => 'Une inscription pour l\' année ' . $annee . ' a déjà été enrégistrée pour cet(te) étudiant(e)!' ,
                        'eleve_inscriptions_in_current_year' => $eleve_inscriptions_in_current_year));

                }else{

                    /**$eleve =  $this->getDoctrine()
                        ->getRepository('AppBundle:Eleve')
                        ->find($inscription->getEleve()->getId());**/

                    $eleve = $inscription[0]->getEleve();

                    $eleve->setNbReinscription($eleve->getNbReinscription() + 1);
                }

            }else{
                $eleve->setNbReinscription(0);
            }


            $eleve->setDateNaiss($datenaiss);
            $eleve->setAutoriseInscription(0); //0=Par defaut reinscription non autorise, 1=Autorise reinscription, >1 = Autorise reinscription n fois

            $inscription = new Inscription();
            $inscription->setDateInscription(new DateTime());
            $inscription->setEtablissement($request->request->get('etablissement'));
            $inscription->setAnnee((new DateTime)->format("Y"));
            $inscription->setAjourne(false);
            $inscription->setPays($this->getUser()->getPays());
            $inscription->setEleve($eleve);
            $inscription->setMotifAjournement("");
            $inscription->setInscriptionApresNbannees(0);


            $operation = new Operation();
            $operation->setInscription($inscription);
            $operation->setLibelle("save");
            $operation->setDateHeure(new DateTime());
            $operation->setAuteur($this->getUser()->getNom() .  " " . $this->getUser()->getPrenom());
            $operation->setTypeOperation(1); //1=enregistement, 2=modification, 0=suppression

            $em = $this->getDoctrine()->getManager();
            $em->persist($eleve);
            $em->persist($inscription);
            $em->persist($operation);


            $em->flush();

            $form = $this->createForm(EleveType::class, new Eleve(), array(
                'action' => $this->generateUrl('inscription_add'),
                'method' => 'POST',
            ));

            return $this->render('AppBundle:Default:inscription/new.html.twig', array('form' => $form->createView(), 'success' => 'Enregistrement réussi!',
                'eleve_inscriptions_in_current_year' => null));


        }

        return $this->render('AppBundle:Default:inscription/new.html.twig', array('form' => $form->createView(), 'eleve_inscriptions_in_current_year' => null));

    }

    /**
     * @Route("/inscription/list",name="inscription_list")
     */
    public function listAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Inscription');

        $annee = (new DateTime)->format("Y");

        $inscriptions = $repository->findInscriptionsByAnneeAndPays($annee, $this->getUser()->getPays());

        return $this->render('AppBundle:Default:inscription/list.html.twig', array('inscriptions' => $inscriptions, 'ajourne' => null,
            'libelle' => "Liste des inscrits de l'année " . (new DateTime)->format("Y")));
    }


    /**
     * @Route("/inscription/list_ajourne",name="inscription_list_ajourne")
     */
    public function listAjourneAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository('AppBundle:Inscription');

        $annee = (new DateTime)->format("Y");

        $inscriptions = $repository->findInscriptionsByStatus(1, $this->getUser()->getPays());

        return $this->render('AppBundle:Default:inscription/list.html.twig', array('inscriptions' => $inscriptions, 'ajourne' => 1,
            'libelle' => "Liste des ajournés de l'année " . (new DateTime)->format("Y")));
    }

    /**
     * @Route("/inscription/edit/{id}",name="inscription_edit")
     */
    public function editAction(Request $request)
    {


    }


    /**
     * @Route("/inscription/ajourner/{id}",name="inscription_ajourner")
     */
    public function ajournerAction(Request $request, $id)
    {
        $inscription = $this->getDoctrine()
            ->getRepository('AppBundle:Inscription')
            ->find($id);

        if (!$inscription) {
            throw $this->createNotFoundException(
                'Aucune inscription trouvée avec l\id ' . $id
            );
        }

        //var_dump($request->get('motif'));die();

        $inscription->setAjourne(true);
        $inscription->setMotifAjournement($request->get('motif'));

        $operation = new Operation();
        $operation->setInscription($inscription);
        $operation->setLibelle("Ajournement");
        $operation->setDateHeure(new DateTime());
        $operation->setAuteur($this->getUser()->getNom() .  " " . $this->getUser()->getPrenom());
        $operation->setTypeOperation(3); //1=enregistement, 2=modification, 0=suppression 3=Ajournement

        $em = $this->getDoctrine()->getManager();
        $em->persist($inscription);
        $em->persist($operation);


        $em->flush();

        return $this->redirect($this->generateUrl('inscription_list'));

    }

    /**
     * @Route("/inscription/autoriser/{id}",name="inscription_autoriser")
     */
    public function autoriserAction(Request $request, $id)
    {
        $inscription = $this->getDoctrine()
            ->getRepository('AppBundle:Inscription')
            ->find($id);

        if (!$inscription) {
            throw $this->createNotFoundException(
                'Aucune inscription trouvée avec l\id ' . $id
            );
        }

        $eleve = $inscription->getEleve();
        $eleve->setAutoriseInscription(1);

        $operation = new Operation();
        $operation->setInscription($inscription);
        $operation->setLibelle("Autoriser");
        $operation->setDateHeure(new DateTime());
        $operation->setAuteur($this->getUser()->getNom() .  " " . $this->getUser()->getPrenom());
        $operation->setTypeOperation(4); //1=enregistement, 2=modification, 0=suppression 3=Ajournement 4=Autoriser

        $em = $this->getDoctrine()->getManager();
        $em->persist($eleve);
        $em->persist($inscription);
        $em->persist($operation);


        $em->flush();

        return $this->redirect($this->generateUrl('inscription_list'));

    }

    /**
     * @Route("/inscription/delete/{id}",name="inscription_delete")
     */
    public function deleteAction(Request $request)
    {


    }


}
