<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Doorlog
 *
 * @ORM\Table(name="Doorlog", indexes={@ORM\Index(name="IDX_7EA00AC721CFA9F6", columns={"cmsUser"}), @ORM\Index(name="IDX_7EA00AC7D7943D68", columns={"area"})})
 * @ORM\Entity
 */
class Doorlog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dir", type="integer", nullable=false)
     */
    private $dir;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Cmsuser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cmsuser", inversedBy="logs")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cmsUser", referencedColumnName="id")
     * })
     */
    private $cmsuser;

    /**
     * @var \AppBundle\Entity\Area
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Area")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="area", referencedColumnName="id")
     * })
     */
    private $area;

    /**
     * @return int
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * @param int $dir
     */
    public function setDir($dir)
    {
        $this->dir = $dir;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Cmsuser
     */
    public function getCmsuser()
    {
        return $this->cmsuser;
    }

    /**
     * @param Cmsuser $cmsuser
     */
    public function setCmsuser($cmsuser)
    {
        $this->cmsuser = $cmsuser;
    }

    /**
     * @return Area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param Area $area
     */
    public function setArea($area)
    {
        $this->area = $area;
    }



}

