<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $password;
}
