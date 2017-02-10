<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use AppBundle\Entity\Personnage;
use AppBundle\Entity\Stats;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PlayersController
 *
 * @author romain-ruperez
 */
class PlayersController extends Controller {

    /**
     * Methode qui va ajouter les joueurs en base de donnée 
     * A la fin du traitement on est redirigé sur le controller de views
     * afin de retourner la vue de creation de personnages
     * 
     * 
     * Si le joueur existe en base de donnée on le met en session
     * sinon on l'enregistre et on le met en session
     * @Route("/players/add", name="addPlayers")
     * @Method({"POST"})
     * @param Request $r
     */
    public function addPlayers(Request $r) {
        $entityManager = $this->getDoctrine()->getManager();

        //boucle sur valeur de 1 a 4
        for ($i = 1; $i <= 4; $i++) {
            //stockage de la valeur dans la variable email
            $email = $r->get('j' . strval($i));



            if ($email != null) {

                //on va chercher l'adresse  mail de l'user dans la DB
                $checkEmail = $entityManager->getRepository(Joueur::class)->findByEmail($email);

                // si un email est trouvé
                if ($checkEmail != null) {
                    // on récupere la session correspondant a l'email
                    $joueur=$checkEmail[0];
                } else {
                    // si nouveau joueur
                    $joueur = new Joueur();
                    $joueur->setEmail($email);
                    $entityManager->persist($joueur);
                }
                // mise en session du joueur
                $r->getSession()->set('j' . strval($i), $joueur);
            }
        }
        $entityManager->flush();
        $r->getSession()->set('actual', 1);
        return $this->redirectToRoute('createPerso');
    }

    // m'a permis de verifier les valeur du formulaire
//        return new Response($r->get("j1"));

    /**
     * @Route("/personnage/create", name="createPerso")
     * @Template("default/creationPersonnage.html.twig")
     */
    public function createCharacter(Request $r) {
        $em = $this->getDoctrine()->getManager();
//        $finalStats = $em->getRepository('AppBundle')
        $personnage = new Personnage;
        $form = $this->createForm('AppBundle\Form\PersonnageType', $personnage);
        $form->handleRequest($r);

        if ($form->isSubmitted() && $form->isValid()) {

            //creation d'un nouvel obj"et stat
            $stats = new Stats();
            //mise a jour de ses valeurs avec les valeurs stats de la classe de la race
            //enregistrement de nos nouvelles stats et ajout des stats dans le personnage
            $stats->setPv($personnage->getRace()->getStats()->getPv() + $personnage->getRace()->getStats()->getPv());
            $stats->setAtt($personnage->getRace()->getStats()->getAtt() + $personnage->getRace()->getStats()->getAtt());
            $stats->setMov($personnage->getRace()->getStats()->getMov() + $personnage->getRace()->getStats()->getMov());
            $stats->setDef($personnage->getRace()->getStats()->getDef() + $personnage->getRace()->getStats()->getDef());


            $personnage->setStats($stats);



            $em->persist($personnage);
            $em->persist($stats);
            $r->getSession()->set('actual', 1);
            $em->flush();
        }

        return array("formulaire" => $form->createView());
    }

    /**
     * 
     * @Route("perso/create",name="savePersonnage")
     * @param Request $r
     */
    public function savePersonnage(Request $r){
        $em = $this->getDoctrine()->getManager();
        $personnage = new Personnage();
                $form = $this->createForm(\AppBundle\Form\PersonnageType::class, $personnage);
                $form->handleRequest($r);
                $em->persist($personnage->majStats());
                $em->persist($personnage);
                $em->flush;
                $this->switchPlayer($r);
               
    }
    
    /** 
     * Doit etre appelée par la validation de la création du personnage precendent !
     * @param Request $r
     * @return type
     */
//    public function switchPlayer(Request $r) {
//        $next = $r->getSession()->get('actuel') + 1;
//        if ($r->getSession()->has('j' . strval($next))) {
//            $r->getSession()->set('actuel', $next);
//            return $this->redirectToRoute('createPerso');
//        }else{
//            return $this->redirectToRoute('game');
//        }
//    }
    
}
