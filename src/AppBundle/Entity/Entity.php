<?php

namespace AppBundle\Entity;

/**
 * Entity
 */
class Entity
{
    /**
     * @var string
     */
    private $entity;
    
    /**
     * Constructor
     * @param string $entity
     * 
     */
    public function __construct($entity) {
        $this->setEntity($entity);
    }
    /**
     * Set entity
     *
     * @param string $entity
     *
     * @return Entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    
        return $this;
    }

    /**
     * Get entity
     *
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
