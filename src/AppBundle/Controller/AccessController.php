<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccessController extends Controller
{
    public function LoginAction()
    {
        if($this->getUser() instanceof User){
            return $this->redirectToRoute('_main');
        }
        $authUtil = $this->get("security.authentication_utils");
        $errors = $authUtil->getLastAuthenticationError();
        $lastUsername = $authUtil->getLastUsername();
        return $this->render('AppBundle:Access:login.html.twig', array(
            'lastUsername' => $lastUsername,
        ));
    }
    
    public function SignupAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        if($this->getUser() instanceof User){
            return $this->redirectToRoute('_main');
        }
        $user = new User();
        $form=$this->createForm(UserType::class,$user);
        $resp=$request->request->all();
        $request->request->replace($resp);
        $form->handleRequest($request);
        $error=null;
        $submitted=false;
        if($form->isSubmitted()){
            $submitted=true;
            if($form->isValid()){
                $now=new \DateTime();
                $user->setTimezone($form->get('timezone')->getData());
                $user->setMemberSince($now);
                $em = $this->getDoctrine()->getManager();
                $password=$encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);
                $em->persist($user);
                $em->flush();
                $this->addFlash('registro', 'Usuario creado con exito');
                return $this->redirectToRoute('_login');
            }
        }
        return $this->render("AppBundle:Access:signup.html.twig",array(
            'form'=>$form->createView(),
            'submitted'=>$submitted
        ));
    }

}
