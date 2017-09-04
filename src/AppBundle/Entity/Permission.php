<?php

namespace AppBundle\Entity;

/**
 * Permission
 */
class Permission
{
    /**
     * @var guid
     */
    private $entityID;

    /**
     * @var boolean
     */
    private $canRead;

    /**
     * @var boolean
     */
    private $canWrite;

    /**
     * @var \AppBundle\Entity\Entity
     */
    private $entity;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;


    /**
     * Set entityID
     *
     * @param guid $entityID
     *
     * @return Permission
     */
    public function setEntityID($entityID)
    {
        $this->entityID = $entityID;
    
        return $this;
    }

    /**
     * Get entityID
     *
     * @return guid
     */
    public function getEntityID()
    {
        return $this->entityID;
    }

    /**
     * Set canRead
     *
     * @param boolean $canRead
     *
     * @return Permission
     */
    public function setCanRead($canRead)
    {
        $this->canRead = $canRead;
    
        return $this;
    }

    /**
     * Get canRead
     *
     * @return boolean
     */
    public function getCanRead()
    {
        return $this->canRead;
    }

    /**
     * Set canWrite
     *
     * @param boolean $canWrite
     *
     * @return Permission
     */
    public function setCanWrite($canWrite)
    {
        $this->canWrite = $canWrite;
    
        return $this;
    }

    /**
     * Get canWrite
     *
     * @return boolean
     */
    public function getCanWrite()
    {
        return $this->canWrite;
    }

    /**
     * Set entity
     *
     * @param \AppBundle\Entity\Entity $entity
     *
     * @return Permission
     */
    public function setEntity(\AppBundle\Entity\Entity $entity)
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Permission
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
