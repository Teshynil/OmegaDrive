<?php

namespace AppBundle\Entity;

/**
 * Trash
 */
class Trash
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $liveUntil;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
}

