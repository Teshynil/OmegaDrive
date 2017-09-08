<?php

namespace AppBundle\Entity;

/**
 * File
 */
class File
{
    /**
     * @var guid
     */
    private $fileID;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var \DateTime
     */
    private $creationDate;

    /**
     * @var \DateTime
     */
    private $lastModifiedDate;

    /**
     * @var \DateTime
     */
    private $lastAccessDate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $childs;

    /**
     * @var \AppBundle\Entity\Folder
     */
    private $folder;

    /**
     * @var \AppBundle\Entity\User
     */
    private $owner;

    /**
     * @var \AppBundle\Entity\Entity
     */
    private $entity;

    /**
     * @var \AppBundle\Entity\File
     */
    private $parent;

    /**
     * @var \AppBundle\Entity\User
     */
    private $lastModifiedBy;

    /**
     * @var \AppBundle\Entity\User
     */
    private $lastAccessBy;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->childs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get fileID
     *
     * @return guid
     */
    public function getFileID()
    {
        return $this->fileID;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return File
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    
        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return File
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    
        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set lastModifiedDate
     *
     * @param \DateTime $lastModifiedDate
     *
     * @return File
     */
    public function setLastModifiedDate($lastModifiedDate)
    {
        $this->lastModifiedDate = $lastModifiedDate;
    
        return $this;
    }

    /**
     * Get lastModifiedDate
     *
     * @return \DateTime
     */
    public function getLastModifiedDate()
    {
        return $this->lastModifiedDate;
    }

    /**
     * Set lastAccessDate
     *
     * @param \DateTime $lastAccessDate
     *
     * @return File
     */
    public function setLastAccessDate($lastAccessDate)
    {
        $this->lastAccessDate = $lastAccessDate;
    
        return $this;
    }

    /**
     * Get lastAccessDate
     *
     * @return \DateTime
     */
    public function getLastAccessDate()
    {
        return $this->lastAccessDate;
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\File $child
     *
     * @return File
     */
    public function addChild(\AppBundle\Entity\File $child)
    {
        $this->childs[] = $child;
    
        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\File $child
     */
    public function removeChild(\AppBundle\Entity\File $child)
    {
        $this->childs->removeElement($child);
    }

    /**
     * Get childs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChilds()
    {
        return $this->childs;
    }

    /**
     * Set folder
     *
     * @param \AppBundle\Entity\Folder $folder
     *
     * @return File
     */
    public function setFolder(\AppBundle\Entity\Folder $folder = null)
    {
        $this->folder = $folder;
    
        return $this;
    }

    /**
     * Get folder
     *
     * @return \AppBundle\Entity\Folder
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set owner
     *
     * @param \AppBundle\Entity\User $owner
     *
     * @return File
     */
    public function setOwner(\AppBundle\Entity\User $owner = null)
    {
        $this->owner = $owner;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return \AppBundle\Entity\User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set entity
     *
     * @param \AppBundle\Entity\Entity $entity
     *
     * @return File
     */
    public function setEntity(\AppBundle\Entity\Entity $entity = null)
    {
        $this->entity = $entity;
    
        return $this;
    }

    /**
     * Get entity
     *
     * @return \AppBundle\Entity\Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\File $parent
     *
     * @return File
     */
    public function setParent(\AppBundle\Entity\File $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\File
     */
    public function getParent()
    {
        return $this->parent;
    }
    /**
     * @var integer
     */
    private $size;


    /**
     * Set size
     *
     * @param integer $size
     *
     * @return File
     */
    public function setSize($size)
    {
        $this->size = $size;
    
        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }
    
    /**
     * Set lastModifiedBy
     *
     * @param \AppBundle\Entity\User $lastModifiedBy
     *
     * @return File
     */
    public function setLastModifiedBy(\AppBundle\Entity\User $lastModifiedBy = null)
    {
        $this->lastModifiedBy = $lastModifiedBy;

        return $this;
    }

    /**
     * Get lastModifiedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getLastModifiedBy()
    {
        return $this->lastModifiedBy;
    }

    /**
     * Set lastAccessBy
     *
     * @param \AppBundle\Entity\User $lastAccessBy
     *
     * @return File
     */
    public function setLastAccessBy(\AppBundle\Entity\User $lastAccessBy = null)
    {
        $this->lastAccessBy = $lastAccessBy;

        return $this;
    }

    /**
     * Get lastAccessBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getLastAccessBy()
    {
        return $this->lastAccessBy;
    }
    
    /**
     * Propiedades Adicionales
     */
    
    /**
     * @var boolean
     */
    private $mark=false;
    /**
     * @var boolean
     */
    private $trash=false;
    /**
     * Metodos adicionales
     */
    public function getIcon(){
        $ext=$this->getExtension();
        if(in_array($ext, ['odm','odt','doc','docx'])){
            return "fa-file-word-o";
        }else if(in_array($ext, ['xls','xlsx','csv','ods','ots'])){
            return "fa-file-excel-o";
        }else if(in_array($ext, ['odp','odg','otp','ppt','pps','pptx','potx'])){
            return "fa-file-powerpoint-o";
        }else if(in_array($ext, ['txt','uot','rtf'])){
            return "fa-file-text-o";
        }else if(in_array($ext, ['tar','bz2','gz','7z','s7z','dmg','rar','zip','pea'])){
            return "fa-file-archive-o";
        }else if(in_array($ext, ['webm','mkv','flv','flv','vob','ogv','ogg','drc','mng','avi','mov','qt','wmv','yuv','rm','rmvb','asf','amv','mp4','m4v','mpg','mp2','mpeg','mpe','mpv','mpg','mpeg','m2v','m4v','svi','3gp','3g2','mxf','roq','nsv','flv','f4v','f4p','f4a','f4b'])){
            return "fa-file-video-o";
        }else if(in_array($ext, ['amr','mp1','mp2','mp3','aac','flac','wma'])){
            return "fa-file-audio-o";
        }else if(in_array($ext, ['bmp','jpeg','jpg','pcx','psd','sgv','wmf','dxf','met','pgm','svm','emf','sda','tga','eps','pcd','png','sdd','tif','tiff','gif','pct','sgf','webp'])){
            return "fa-file-image-o";
        }else if(in_array($ext, ['pdf'])){
            return "fa-file-pdf-o";
        }else {
            return "fa-file-o";
        }
    }
    
    public function setMark($mark){
        $this->mark=$mark;
    }
    
    public function getMark(){
        return $this->mark;
    }
    
    public function setTrash($trash){
        $this->trash=$trash;
    }
    
    public function getTrash(){
        return $this->trash;
    }
    public function getEncoded(){
        $data=[
            'id'=>$this->getFileID(),
            'entity'=>$this->getEntity()->getEntity()
        ];
        $json=json_encode($data,JSON_UNESCAPED_UNICODE);
        return base64_encode($json);
    }
}
