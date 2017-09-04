<?php

namespace AppBundle\Entity;

/**
 * Folder
 */
class Folder
{
    /**
     * @var guid
     */
    private $folderID;

    /**
     * @var string
     */
    private $name;

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
     * @var \AppBundle\Entity\User
     */
    private $owner;

    /**
     * @var \AppBundle\Entity\Entity
     */
    private $entity;

    /**
     * @var \AppBundle\Entity\Folder
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->childs = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get folderID
     *
     * @return guid
     */
    public function getFolderID()
    {
        return $this->folderID;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Folder
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Folder
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
     * @return Folder
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
     * @return Folder
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
     * @param \AppBundle\Entity\Folder $child
     *
     * @return Folder
     */
    public function addChild(\AppBundle\Entity\Folder $child)
    {
        $this->childs[] = $child;
    
        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\Folder $child
     */
    public function removeChild(\AppBundle\Entity\Folder $child)
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
     * Set owner
     *
     * @param \AppBundle\Entity\User $owner
     *
     * @return Folder
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
     * @return Folder
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
     * @param \AppBundle\Entity\Folder $parent
     *
     * @return Folder
     */
    public function setParent(\AppBundle\Entity\Folder $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\Folder
     */
    public function getParent()
    {
        return $this->parent;
    }
}
