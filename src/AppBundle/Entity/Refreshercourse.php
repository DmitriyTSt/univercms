<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Refreshercourse
 *
 * @ORM\Table(name="RefresherCourse", indexes={@ORM\Index(name="IDX_79F2E4421CFA9F6", columns={"cmsUser"})})
 * @ORM\Entity
 */
class Refreshercourse
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=256, nullable=false)
     */
    private $title;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cmsuser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cmsUser", referencedColumnName="id")
     * })
     */
    private $cmsuser;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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



}

