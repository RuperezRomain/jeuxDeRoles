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
     * @Route("/players/add", name="addPlayers")
     * @param Request $r
     */
    public function addPlayers(Request $r) {



        return $this->redirectToRoute('createPerso');
        // m'a permis de verifier les vaaleurs du formulaires=
//        return new Response($r->get("j1"));
    }

}
