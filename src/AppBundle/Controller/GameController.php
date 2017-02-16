<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of GameController
 *
 * @author romain-ruperez
 */
class GameController extends Controller {

    /**
     * Cette fonction ne s'exécute que si le mouvement est valide.
     * Cette fonction utilise les coordonnées retournées par le formulaire
     * et les assigne au personnage du joueur courant.
     * Le formulaire sera dynamiquement rempli à l'aide d'un script js qui
     * récupèrera les valeurs de la ligne et de la colonne selectionées sur le
     * plateau de jeu via un clic.
     * Le premier champ du formulaire contiendra la valeur de la ligne, le
     * second champ du formulaire contiendra la valeur de la colonne.
     * Le formulaire doit rediriger sur une url structurée telle que la route
     * ci-dessous.
     * 
     * @Route("/game/move", name="move")
     */
    public function setDeplacement(Request $r) {
        $ligne = $r->get("ligne");
        $colonne = $r->get("colonne");
        $em = $this->getDoctrine()->getManager();
        // On récupère le joueur actuel en session
        $joueur = $r->getSession()->get("j" . strval($r->getSession()->get('actuel')));
        // On apelle la méthode seDeplacer du personnage du joueur actuel
        $joueur->getPersonnage()->seDeplacer($ligne, $colonne);
        // On enlève un PA au personnage du joueur
        $joueur->getPersonnage()->setPa($joueur->getPersonnage()->getPa() - 1);
        // On merge les nouvelles valeurs au personnage
        $em->merge($joueur->getPersonnage());
        $em->flush();
        return $this->redirectToRoute("game");
    }

    /**
     * Cette fonction ne s'éxécute que si l'attaque est valide (la cible n'est
     * pas hors de portée).
     * 
     * 
     * @param Request $r
     * @param type $cible
     * @Route("/game/attack/{cible}", name="attack")
     */
    public function doAttack(Request $r, $cible) {
        $em = $this->getDoctrine()->getManager();
        // On récupère le joueur actuel en session
        $joueur = $r->getSession()->get("j" . strval($r->getSession()->get('actuel')));
        // On appelle la méthode attaquer avec la cible de l'attaque en paramètre
        $joueur->getPersonnage()->attaquer($cible);
        // On enlève un PA au personnage du joueur
        $joueur->getPersonnage()->setPa($joueur->getPersonnage()->getPa() - 1);
        // On merge le retrait de PA au personnage du joueur actuel
        $em->merge($joueur->getPersonnage());
        // On merge le retrait de PV au personnage cible
        $em->merge($cible->getPersonnage());
        $em->flush();
//        return $this->redirectToRoute("game");
        return new Response($cible);
    }

}
