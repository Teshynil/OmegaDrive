<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;

class MainController extends Controller
{
    public function MainAction()
    {
        if(!($this->getUser() instanceof User)){
            return $this->redirectToRoute('_login');
        }
        return $this->render('AppBundle:Main:main.html.twig', array(
            // ...
        ));
    }
    
    public function StartAction()
    {
        
        return $this->render('AppBundle:Main:drive.html.twig', array(
            // ...
        ));
    }
    
    public function DriveAction()
    {
        
        return $this->render('AppBundle:Main:drive.html.twig', array(
            // ...
        ));
    }
    
    public function SharedAction()
    {
        
        return $this->render('AppBundle:Main:drive.html.twig', array(
            // ...
        ));
    }
    
    public function TrashAction()
    {
        
        return $this->render('AppBundle:Main:Trash.html.twig', array(
            // ...
        ));
    }
}
