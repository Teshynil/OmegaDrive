<?php

namespace AppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTime
     */
    private $memberSince;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $favoriteFiles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $favoriteFolders;
    
    /**
     * @var string
     */
    private $timezone;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->favoriteFiles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->favoriteFolders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    public function getSalt() {
        return $this->getMemberSince()->getTimestamp();
        
    }
    public function eraseCredentials() {
        return null;
    }
    public function getRoles() {
        return [];
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set memberSince
     *
     * @param \DateTime $memberSince
     *
     * @return User
     */
    public function setMemberSince($memberSince)
    {
        $this->memberSince = $memberSince;
    
        return $this;
    }

    /**
     * Get memberSince
     *
     * @return \DateTime
     */
    public function getMemberSince()
    {
        return $this->memberSince->setTimezone($this->getTimezone());
    }
    
    /**
     * Get memberSinceString
     *
     * @return \DateTime
     */
    public function getMemberSinceString()
    {
        return $this->getMemberSince()->format("d/m/Y");
    }

    /**
     * Add favoriteFile
     *
     * @param \AppBundle\Entity\File $favoriteFile
     *
     * @return User
     */
    public function addFavoriteFile(\AppBundle\Entity\File $favoriteFile)
    {
        $this->favoriteFiles[] = $favoriteFile;
    
        return $this;
    }

    /**
     * Remove favoriteFile
     *
     * @param \AppBundle\Entity\File $favoriteFile
     */
    public function removeFavoriteFile(\AppBundle\Entity\File $favoriteFile)
    {
        $this->favoriteFiles->removeElement($favoriteFile);
    }

    /**
     * Get favoriteFiles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavoriteFiles()
    {
        return $this->favoriteFiles;
    }

    /**
     * Add favoriteFolder
     *
     * @param \AppBundle\Entity\Folder $favoriteFolder
     *
     * @return User
     */
    public function addFavoriteFolder(\AppBundle\Entity\Folder $favoriteFolder)
    {
        $this->favoriteFolders[] = $favoriteFolder;
    
        return $this;
    }

    /**
     * Remove favoriteFolder
     *
     * @param \AppBundle\Entity\Folder $favoriteFolder
     */
    public function removeFavoriteFolder(\AppBundle\Entity\Folder $favoriteFolder)
    {
        $this->favoriteFolders->removeElement($favoriteFolder);
    }

    /**
     * Get favoriteFolders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFavoriteFolders()
    {
        return $this->favoriteFolders;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return User
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    
        return $this;
    }

    /**
     * Get timezone
     *
     * @return \DateTimeZone
     */
    public function getTimezone()
    {        
        return new \DateTimeZone($this->timezone);
    }
    
    /**
     * Get timezone String
     *
     * @return string
     */
    public function getTimezoneString()
    {        
        return $this->timezone;
    }
}
