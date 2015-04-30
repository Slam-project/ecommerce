<?php

namespace EasySlam\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use EasySlam\ProductBundle\Entity\Commands;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="\EasySlam\ProductBundle\Entity\Commands", mappedBy="user", cascade={"persist"})
     */
    protected $commands;

    /**
     * Create an array collection to use OneToMany
     */
    public function __construct()
    {
        parent::__construct();
        $this->commands = new ArrayCollection();
    }

    /**
     * Add a new command to user
     *
     * @param \EasySlam\ProductBundle\Entity\Commands $command
     * @return User
     */
    public function addCommand(Commands $command)
    {
        $this->commands->add($command);

        return $this;
    }

    /**
     * Remove a command
     *
     * @param \EasySlam\ProductBundle\Entity\Commands $command
     */
    public function removeCommand(Commands $command)
    {
        $this->commands->removeElement($command);
    }

    /**
     * Return list of commands
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCommands()
    {
        return $this->commands;
    }
}