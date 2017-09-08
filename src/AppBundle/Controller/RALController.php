<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RALController extends Controller
{
    public function indexAction($request=NULL)
    {
        if($request===NULL){
            throw $this->createNotFoundException();
        }else{
            $kernel = $this->get('kernel');
            try{
                $path = $kernel->locateResource("@AppBundle/Resources/assets/$request.twig");
            } catch (\Exception $e){
                throw $this->createNotFoundException();
            }
        echo $this->renderView($path);die();
        }
    }

}
