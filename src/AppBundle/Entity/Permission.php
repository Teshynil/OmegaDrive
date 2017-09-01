<?php

namespace AppBundle\Entity;

/**
 * Permission
 */
class Permission
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $canRead;

    /**
     * @var bool
     */
    private $canWrite;


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
}

