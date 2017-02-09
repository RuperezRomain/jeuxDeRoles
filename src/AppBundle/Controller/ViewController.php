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
 * Description of ViewController
 *
 * @author romain-ruperez
 */
class ViewController extends Controller {

    /**
     * 
     * @Route("/home", name="home")
     * @return Response Response
     */
    public function getHome(Request $r) {
        if ($r->getMethod() == "GET") {
            return $this->render('home.html.twig');
        } else {
            return new Response("Home");
        }
    }

}
