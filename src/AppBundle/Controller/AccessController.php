<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccessController extends Controller
{
    public function LoginAction()
    {
        return $this->render('AppBundle:Access:login.html.twig', array(
            // ...
        ));
    }

    public function LogoutAction()
    {
        return $this->render('AppBundle:Access:logout.html.twig', array(
            // ...
        ));
    }

}
