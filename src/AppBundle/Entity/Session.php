<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sessions")
 */
class Session
{
    /**
     * @ORM\Column(type="string", length=128)
     * @ORM\Id
     */
    private $sessId;

    /**
     * @ORM\Column(type="binary")
     */
    private $sessData;

    /**
     * @ORM\Column(type="integer", length=10)
     */
    private $sessTime;

    /**
     * @ORM\Column(type="integer", length=9)
     */
    private $sessLifetime;

    /**
     * Set sessId
     *
     * @param string $sessId
     * @return Session
     */
    public function setSessId($sessId)
    {
        $this->sessId = $sessId;

        return $this;
    }

    /**
     * Get sessId
     *
     * @return string 
     */
    public function getSessId()
    {
        return $this->sessId;
    }

    /**
     * Set sessData
     *
     * @param binary $sessData
     * @return Session
     */
    public function setSessData($sessData)
    {
        $this->sessData = $sessData;

        return $this;
    }

    /**
     * Get sessData
     *
     * @return binary 
     */
    public function getSessData()
    {
        return $this->sessData;
    }

    /**
     * Set sessTime
     *
     * @param integer $sessTime
     * @return Session
     */
    public function setSessTime($sessTime)
    {
        $this->sessTime = $sessTime;

        return $this;
    }

    /**
     * Get sessTime
     *
     * @return integer 
     */
    public function getSessTime()
    {
        return $this->sessTime;
    }

    /**
     * Set sessLifetime
     *
     * @param integer $sessLifetime
     * @return Session
     */
    public function setSessLifetime($sessLifetime)
    {
        $this->sessLifetime = $sessLifetime;

        return $this;
    }

    /**
     * Get sessLifetime
     *
     * @return integer 
     */
    public function getSessLifetime()
    {
        return $this->sessLifetime;
    }
}
