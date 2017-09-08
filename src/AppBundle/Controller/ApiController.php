<?php

namespace AppBundle\Controller;

use AppBundle\Entity\File;
use AppBundle\Entity\Trash;
use AppBundle\Helpers\Helper;
use DateInterval;
use DateTime;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiController extends Controller {

    public function SubmitAction(Request $request) {
        $me = $this->getUser();
        $em = $this->getDoctrine()->getManager();
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
                ->setCreationDate(new DateTime())
                ->setLastAccessDate(new DateTime())
                ->setLastModifiedDate(new DateTime())
                ->setOwner($this->getUser())
                ->setLastAccessBy($this->getUser())
                ->setLastModifiedBy($this->getUser())
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
        $ufile->move($path, $file->getFileID());
        die();
    }

    /**
     * 
     * @param File $item
     * @throws NotFoundHttpException
     */
    public function MarkAction($item = NULL) {
        $me = $this->getUser();
        $item=Helper::decode($item);
        $item=$item->id;
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('1', 'Result');
        \header('Content-Type: application/json');
        $response = ['ok' => FALSE, 'mark' => FALSE];
        if ($item !== NULL) {
            $em = $this->getDoctrine()->getManager();
            $query = $em->find('AppBundle:File', $item);
            if ($query !== NULL) {
                $item = $query;
                $query = $em->createNativeQuery(
                        'SELECT 1 '
                        . 'FROM FAVORITEFILES '
                        . 'WHERE USER=? AND FILE=?', $rsm);
                $query->setParameter(1, $me->getUsername())->setParameter(2, $item->getFileID());
                $result = $query->getResult();
                if (count($result) > 0) {
                    $me->removeFavoriteFile($item);
                    $response['mark'] = FALSE;
                }else{
                    $me->addFavoriteFile($item);
                    $response['mark'] = TRUE;
                }
                $em->persist($me);
                $em->flush();
                $response['ok'] = TRUE;
            }
        }
        echo json_encode($response);
        die();
    }

    /**
     * 
     * @param File $item
     * @throws NotFoundHttpException
     */
    public function DeleteAction($item = NULL) {
        $item=Helper::decode($item);
        $item=$item->id;
        \header('Content-Type: application/json');
        $response = ['ok' => FALSE];
        if ($item !== NULL) {
            $em = $this->getDoctrine()->getManager();
            $query = $em->find('AppBundle:File', $item);
            if ($query !== NULL) {
            $item = $query;
            $trash = new Trash();
            $trash->setEntity($item->getEntity())
                    ->setEntityID($item->getFileID())
                    ->setLiveUntil((new DateTime("now"))->add(new DateInterval("P1M")));
            $em->persist($trash);
            $em->flush();
            $response['ok']=TRUE;
            }
        }
        echo json_encode($response);
        die();
    }

    /**
     * 
     * @param File $item
     * @throws NotFoundHttpException
     */
    public function DropAction($item = NULL) {
        if ($item === NULL) {
            throw $this->createNotFoundException();
        } else {
            $em = $this->getDoctrine()->getManager();
            $query = $em->find('AppBundle:File', $item);
            if ($query === NULL) {
                throw $this->createNotFoundException();
            }
            $item = $query;
            $trash = $em->getRepository('AppBundle:Trash')->findOneBy(
                    ['entityID' => $item->getFileID()
                        , 'entity' => $item->getEntity()->getEntity()]);
            if ($trash == NULL) {
                throw $this->createNotFoundException();
            }
            $em->remove($trash);
            $em->remove($item);
            $em->flush();
        }
        die();
    }

    public function ShareAction() {
        return $this->render('AppBundle:Api:share.html.twig', array(
                        // ...
        ));
    }

    /**
     * 
     * @param File $item
     * @throws NotFoundHttpException
     */
    public function RecoverAction($item = NULL) {
        $item=Helper::decode($item);
        $item=$item->id;
        \header('Content-Type: application/json');
        $response = ['ok' => FALSE];
        if ($item !== NULL) {
            $em = $this->getDoctrine()->getManager();
            $query = $em->find('AppBundle:File', $item);
            if ($query !== NULL) {
                $item = $query;
                $trash = $em->getRepository('AppBundle:Trash')->findOneBy(
                        ['entityID' => $item->getFileID()
                            , 'entity' => $item->getEntity()->getEntity()]);
                if ($trash !== NULL) {
                    $em->remove($trash);
                    $em->flush();
                    $response['ok']=TRUE;
                }
            }
        }
        echo json_encode($response);
        die();
    }

}
