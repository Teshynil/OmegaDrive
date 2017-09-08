<?php

namespace AppBundle\Entity;

/**
 * Trash
 */
class Trash
{
    /**
     * @var guid
     */
    private $entityID;

    /**
     * @var \DateTime
     */
    private $liveUntil;

    /**
     * @var \AppBundle\Entity\Entity
     */
    private $entity;


    /**
     * Set entityID
     *
     * @param guid $entityID
     *
     * @return Trash
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
     * Set liveUntil
     *
     * @param \DateTime $liveUntil
     *
     * @return Trash
     */
    public function setLiveUntil($liveUntil)
    {
        $this->liveUntil = $liveUntil;
    
        return $this;
    }

    /**
     * Get liveUntil
     *
     * @return \DateTime
     */
    public function getLiveUntil()
    {
        return $this->liveUntil;
    }

    /**
     * Set entity
     *
     * @param \AppBundle\Entity\Entity $entity
     *
     * @return Trash
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
     * @var \AppBundle\Entity\User
     */
    private $deletedBy;


    /**
     * Set deletedBy
     *
     * @param \AppBundle\Entity\User $deletedBy
     *
     * @return Trash
     */
    public function setDeletedBy(\AppBundle\Entity\User $deletedBy = null)
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }

    /**
     * Get deletedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }
}
