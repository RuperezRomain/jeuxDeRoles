<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Joueur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

            //on va chercher l'adresse  mail de l'user dans la DB
            $checkEmail = $entityManager->getRepository(Joueur::class)->findByEmail($email);

            if ($email != null) {

                // si un email est trouvé
                if ($checkEmail != null) {
                    // on récupere la session correspondant a l'email
                    $r->getSession()->set('j' . strval($i), $checkEmail);
                    // on redirige sur la homepage
                    return $this->redirectToRoute('homepage');
//                    return new Response($email . " possède déjà un compte");
                } else {
                    // si nouveau joueur
                    $joueur = new Joueur();
                    $joueur->setEmail($email);
                    $entityManager->persist($joueur);
                    // mise en session du joueur
                    $r->getSession()->set('j' . strval($i), $joueur);
                    return $this->redirectToRoute('createPerso');
                }
            }
        }

        $entityManager->flush();



        // m'a permis de verifier les valeur du formulaire
//        return new Response($r->get("j1"));
    }

}
