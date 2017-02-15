<?php

namespace AppBundle\Controller;

use AppBundle\Form\PersonnageType;
use AppBundle\Form\StatsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/personnage/create", name="createPerso")
     */
    public function creationPersonnage(Request $request) {
        //création du formulaire basé sur le Personnage
        $form = $this->createForm(PersonnageType::class);
        //Recuperation de l'objet joueur en session
        $numeroDuJoueur = $request->getSession()->get('actuel');
        $numeroDuJoueurEnChaineDeCaractere = strval($numeroDuJoueur);
        $joueur = $request->getSession()->get("j" . $numeroDuJoueurEnChaineDeCaractere);
        // on retourne tout sur la vue twig
        return $this->render('default/creationPersonnage.html.twig', array(
                    "j" => $joueur,
                    "joueur" => $request->getSession()->get("j" . strval($request->getSession()->get('actuel'))),
                    "formulaire" => $form->createView()
        ));
    }

    /**
     * @Route("/stats",name="statsInit")
     */
    public function creationStatsPerso(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $joueur = $request->getSession()->get("j" . strval($request->getSession()->get('actuel')));
        $idStats = $joueur->getPersonnage()->getStats()->getId();
        $stats = $em->find("AppBundle:Stats", $idStats);
        $formStats = $this->createForm(StatsType::class, $stats);
        //// Metohde retourne nombre 
        $numRandom = $this->randomStats();
        ///// Recup pour adition en twig 
        $pv = $stats->getPv();
        $att = $stats->getAtt();
        $deff = $stats->getDef();
        $mov = $stats->getMov();
        return $this->render('default/selectStats.html.twig', array(
                    "formulaire" => $formStats->createView(),
                    'rd' => $numRandom,
                    'pv' => $pv,
                    'att' => $att,
                    'def' => $deff,
                    'mov' => $mov
        ));
    }

    /**
     * @Route("/game", name="game")
     */
    public function getGameUI(Request $request) {
        // replace this example code with whatever you need
        return $this->render('default/game_ui.twig');
    }

    /**
     * 
     * @Route("/stats", name="stats")
     */
    public function getStats(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $joueur = $request->getSession()->get("j" . strval($request->getSession()->get('actuel')));

        $idStats = $joueur->getPersonnage()->getStats()->getId();

        $stats = $em->find("AppBundle:Stats", $idStats);


        $formStats = $this->createForm(StatsType::class, $stats);


        return $this->render('default/stats.html.twig', array(
                    "editStats" => $formStats->createView(), "joueur" => $joueur
        ));
    }

}
