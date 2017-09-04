<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MainController extends Controller {

    public function MainAction() {
        if (!($this->getUser() instanceof User)) {
            return $this->redirectToRoute('_login');
        }
        return $this->render('AppBundle:Main:main.html.twig', array(
                        // ...
        ));
    }

    public function StartAction() {

        return $this->render('AppBundle:Main:drive.html.twig', array(
                        // ...
        ));
    }

    public function DriveAction(Request $request) {
        $context=$request->request->get('uploadContext',NULL);
        $em=$this->getDoctrine()->getManager();
        $me=$this->getUser();
        if($context!==NULL){
            $folder=$em->find('AppBundle:Folder', $context);
            if($folder==NULL){
                $folder=NULL;
            }else{
                $folder=$folder->getFolderID();
            }
        }else{
            $folder=NULL;
        }
        $files=$em->getRepository('AppBundle:File')->findBy(['owner'=>$me->getUsername(),'folder'=>$folder,'parent'=>NULL]);
        return $this->render('AppBundle:Main:drive.html.twig', array(
            'files'=>$files
        ));
    }

    public function SharedAction(Request $request) {

        return $this->render('AppBundle:Main:drive.html.twig', array(
                        // ...
        ));
    }

    public function TrashAction() {

        return $this->render('AppBundle:Main:Trash.html.twig', array(
                        // ...
        ));
    }

    public function ProfileAction($username = FALSE) {
        if ($username === FALSE) {
            $user = $this->getUser();
        } else {
            $query = $this->getDoctrine()->getManager()->find('AppBundle:User', $username);
            if ($query === NULL) {
                $this->createNotFoundException();
            } else {
                $user = $query;
            }
        }
        return $this->render('AppBundle:Main:Profile.html.twig', array(
                    'user' => $user,
        ));
    }

    public function EditProfileAction(Request $request, UserPasswordEncoderInterface $encoder) {
        $timezones = ['' => ''];
        foreach (timezone_identifiers_list() as $value) {
            $timezones[$value] = $value;
        }
        $form = $this->createFormBuilder()
                ->add('lastpassword', PasswordType::class)
                ->add('newpassword', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Las contraseñas deben coincidir.',
                    'first_name' => 'newpassword',
                    'second_name' => 'confirm_newpassword',
                    'required' => false,
                ])
                ->add('timezone', ChoiceType::class, [
                    'mapped' => false,
                    'label' => 'Zona horaria',
                    'choices' => $timezones,
                    'data' => $this->getUser()->getTimezoneString()
                ])
                ->add('submit', SubmitType::class, ['label' => 'Actualizar'])
                ->getForm();
        $submitted = false;
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $submitted = true;
            $user = $this->getUser();
            $lastpass = $form->get('lastpassword')->getData();
            if ($encoder->isPasswordValid($user, $lastpass)) {
                if ($form->isValid()) {
                    if (!$form->get('newpassword')->isEmpty()) {
                        $newpass = $encoder->encodePassword($user, $form->get('newpassword')->getData());
                        $user->setPassword($newpass);
                    }
                    $user->setTimezone($form->get('timezone')->getData());
                    $this->getDoctrine()->getManager()->persist($user);
                    $this->getDoctrine()->getManager()->flush();
                    return $this->ProfileAction();
                }
            } else {
                $form->get('lastpassword')->addError(new FormError("Contraseña incorrecta"));
            }
        }
        return $this->render('AppBundle:Main:EditProfile.html.twig', array(
                    'form' => $form->createView(),
                    'submitted' => $submitted
        ));
    }

}
