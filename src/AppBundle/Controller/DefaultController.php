<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("/personnage/create", name="createPerso")
     */
    public function creationPersonnage(Request $request)
    {
        $form = $this-> createForm(PersonnageType::class);
        $numeroDuJoueur = $request->getSession()->get('actual');
        $numeroDuJoueurEnChaineDeCaractere = strval($numeroDuJoueur);
        $joueur = $request->getSession()->get("j" . $numeroDuJoueurEnChaineDeCaractere);
        
        
        return $this->render('default/creationPersonnage.html.twig',array(
            "j" => $joueur,
            "joueur" => $request->getSession()->get("j" . strval($request->getSession()->get('actual'))),
            "formulaire" => $form->createView()
                ));
        
    }
}
