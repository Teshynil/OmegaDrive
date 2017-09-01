<?php

namespace AppBundle\Entity;

/**
 * Folder
 */
class Folder
{
    /**
     * @var int
     */
    private $id;

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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
}

