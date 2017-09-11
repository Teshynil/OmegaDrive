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
     * Get livePercent
     *
     * @return float
     */
    public function getLivePercent()
    {
        $i=\date_diff(new \DateTime("now"), $this->getLiveUntil());
        $s=($i->y * 365 * 24 * 60 * 60) + ($i->m * 30 * 24 * 60 * 60) + ($i->d * 24 * 60 * 60) + ($i->h * 60 * 60) + ($i->i * 60) + $i->s; 
        $f1=$s*($i->invert==1?-1:1);
        $i=\date_diff($this->getDeletedOn(), $this->getLiveUntil());
        $s=($i->y * 365 * 24 * 60 * 60) + ($i->m * 30 * 24 * 60 * 60) + ($i->d * 24 * 60 * 60) + ($i->h * 60 * 60) + ($i->i * 60) + $i->s; 
        $f2=$s*($i->invert==1?-1:1);
        return (($f2-$f1)*100)/$f2;
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
    /**
     * @var \DateTime
     */
    private $deletedOn;


    /**
     * Set deletedOn
     *
     * @param \DateTime $deletedOn
     *
     * @return Trash
     */
    public function setDeletedOn($deletedOn)
    {
        $this->deletedOn = $deletedOn;
    
        return $this;
    }

    /**
     * Get deletedOn
     *
     * @return \DateTime
     */
    public function getDeletedOn()
    {
        return $this->deletedOn;
    }
    /**
     * @var guid
     */
    private $trashID;


    /**
     * Get trashID
     *
     * @return guid
     */
    public function getTrashID()
    {
        return $this->trashID;
    }
    
}
