<?php

namespace AppBundle\Controller;

use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller {

    public function SubmitAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        /** @var UploadedFile $file */
        //$ufile=new UploadedFile();
        $ufile = $request->files->get('uploaded-file');
        $context = $request->request->get('uploadContext', NULL);
        $file = new File();
        $efile = $em->find('AppBundle:Entity', 'File');
        $name = $ufile->getClientOriginalName();
        $ext = $ufile->getClientOriginalExtension();
        $name = preg_replace("/\.$ext$/", '', $name);
        $file->setName($name)
                ->setExtension($ext)
                ->setSize($ufile->getSize())
                ->setCreationDate(new \DateTime())
                ->setLastAccessDate(new \DateTime())
                ->setLastModifiedDate(new \DateTime())
                ->setOwner($this->getUser())
                ->setEntity($efile);
        if ($context !== NULL) {
            $query = $em->find('AppBundle:Folder', $context);
            if ($query !== NULL) {
                $file->setFolder($query);
            }
        }
        $em->persist($file);
        $em->flush();
        $kernel = $this->get('kernel');
        $path = $kernel->locateResource('@AppBundle/Drive/');
        $ufile->move($path,$file->getFileID());
        die();
    }

    public function DeleteAction() {
        return $this->render('AppBundle:Api:delete.html.twig', array(
                        // ...
        ));
    }

    public function DropAction() {
        return $this->render('AppBundle:Api:drop.html.twig', array(
                        // ...
        ));
    }

    public function ShareAction() {
        return $this->render('AppBundle:Api:share.html.twig', array(
                        // ...
        ));
    }

    public function RecoverAction() {
        return $this->render('AppBundle:Api:recover.html.twig', array(
                        // ...
        ));
    }

}
