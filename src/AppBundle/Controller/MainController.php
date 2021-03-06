<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Doctrine\ORM\Query\ResultSetMapping;
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
        $em = $this->getDoctrine()->getManager();
        $me = $this->getUser();
        $files = $me->getFavoriteFiles();
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('1', 'Result');
        foreach ($files as $file) {
            $file->setMark(true);
            $query = $em->createNativeQuery(
                    'SELECT 1 '
                    . 'FROM TRASHBIN '
                    . 'WHERE ENTITYID=? AND ENTITY=?', $rsm);
            $query->setParameter(1, $file->getFileID())->setParameter(2, $file->getEntity());
            $result = $query->getResult();
            if (count($result) > 0) {
                $file->setTrash(true);
            }
        }
        return $this->render('AppBundle:Main:favs.html.twig', array(
                    'files' => $files,
                    'uploadContext' => ''
        ));
    }

    public function DriveAction(Request $request) {
        $context = $request->request->get('uploadContext', '');
        $em = $this->getDoctrine()->getManager();
        $me = $this->getUser();
        if ($context !== '') {
            $folder = $em->find('AppBundle:Folder', $context);
            if ($folder == NULL) {
                $folder = NULL;
            } else {
                $folder = $folder->getFolderID();
            }
        } else {
            $folder = NULL;
        }
        $files = $em->getRepository('AppBundle:File')->findBy(['owner' => $me->getUsername(), 'folder' => $folder, 'parent' => NULL]);
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('1', 'Result');
        foreach ($files as $file) {
            $query = $em->createNativeQuery(
                    'SELECT 1 '
                    . 'FROM FAVORITEFILES '
                    . 'WHERE USER=? AND FILE=?', $rsm);
            $query->setParameter(1, $me->getUsername())->setParameter(2, $file->getFileID());
            $result = $query->getResult();
            if (count($result) > 0) {
                $file->setMark(true);
            }
            $query = $em->createNativeQuery(
                    'SELECT 1 '
                    . 'FROM TRASHBIN '
                    . 'WHERE ENTITYID=? AND ENTITY=?', $rsm);
            $query->setParameter(1, $file->getFileID())->setParameter(2, $file->getEntity());
            $result = $query->getResult();
            if (count($result) > 0) {
                $file->setTrash(true);
            }
        }
        return $this->render('AppBundle:Main:drive.html.twig', array(
                    'files' => $files,
                    'uploadContext' => $context
        ));
    }

    public function SharedAction(Request $request) {

        return $this->render('AppBundle:Main:shared.html.twig', array(
                        // ...
        ));
    }

    public function TrashAction() {
        $me = new User();
        $em = $this->getDoctrine()->getManager();
        $me = $this->getUser();
        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('AppBundle:Trash', 't');
        $rsm->addFieldResult('t', 'trashID', 'trashID');
        $rsm->addFieldResult('t', 'entityID', 'entityID');
        $rsm->addFieldResult('t', 'liveUntil', 'liveUntil');
        $rsm->addFieldResult('t', 'deletedOn', 'deletedOn');
        $rsm->addJoinedEntityResult('AppBundle:User', 'delBy', 't', 'deletedBy');
        $rsm->addFieldResult('delBy', 'username', 'username');
        $rsm->addEntityResult('AppBundle:File', 'f');
        $rsm->addFieldResult('f', 'fileID', 'fileID');
        $rsm->addFieldResult('f', 'name', 'name');
        $rsm->addFieldResult('f', 'extension', 'extension');
        $rsm->addFieldResult('f', 'creationDate', 'creationDate');
        $rsm->addFieldResult('f', 'lastModifiedDate', 'lastModifiedDate');
        $rsm->addFieldResult('f', 'lastAccessDate', 'lastAccessDate');
        $rsm->addFieldResult('f', 'size', 'size');
        $rsm->addJoinedEntityResult('AppBundle:Entity', 'e', 'f', 'entity');
        $rsm->addFieldResult('e', 'entity', 'entity');
        $sql =    'SELECT t.trashID, t.entityID, t.liveUntil, t.deletedOn, delBy.username, '
                . 'f.fileID, f.name, f.extension, f.creationDate, f.lastModifiedDate, f.lastAccessDate, f.size, e.entity '
                . 'FROM trashbin t '
                . 'JOIN users delBy ON(t.deletedBy=delBy.username) '
                . 'JOIN files f ON(t.entityID=f.fileID) '
                . 'JOIN entities e ON(e.entity=f.entity) '
                . 'WHERE t.entity=f.entity '
                . 'AND f.owner=?';
        $query = $em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $me->getUsername());
        $result = $query->getResult();
        
        for ($i = 0; $i < count($result); $i+=2) {
            $file['trash']=$result[$i];
            $file['object']=$result[$i+1];
            $files[]=$file;
        }
        return $this->render('AppBundle:Main:trash.html.twig', array(
                    'files' => $files,
                    'uploadContext' => ''
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
