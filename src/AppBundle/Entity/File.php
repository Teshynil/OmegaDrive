<?php

namespace AppBundle\Entity;

/**
 * File
 */
class File
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
}

