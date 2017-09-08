<?php
namespace AppBundle\Twig;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RequestContext;
class TwigHelper extends \Twig_Extension{

    private $context;
    private $container;

    public function __construct(ContainerInterface $container , TokenStorageInterface $context) {
        $this->container = $container;
        $this->context = $context;
    }
    
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('isLogged',array($this,"isLogged"),array('needs_context' => true)),
            new \Twig_SimpleFunction('dateHuman',array($this,"dateHuman")),
            new \Twig_SimpleFunction('bytesConvert',array($this,"bytesConvert")),
        );
    }
    public function isLogged($context){
        $cx=$this->container->get('router')->getContext();
        if(!($this->context->getToken()->getUser() instanceof \AppBundle\Entity\User)){
            header('Location: '.$cx->getScheme().'://'.$cx->getHost().$cx->getBaseUrl());
            die();
        }
        return null;
    }
    public function dateHuman($date,$format="d/m/Y"){
        $tz=$this->context->getToken()->getUser()->getTimezone();
        $date->setTimezone($tz);
        return $date->format($format);
    }
    public function bytesConvert($bytes){
        $GB=$bytes/1000000000;
        $MB=$bytes/1000000;
        $KB=$bytes/1000;
        $B=$bytes;
        if($GB>=1)
            return round($GB,3)."GB";
        if($MB>=1)
            return round($MB,3)."MB";
        if($KB>=1)
            return round($KB,3)."KB";
        return $B."Bytes";
    }
}