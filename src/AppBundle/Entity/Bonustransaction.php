<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bonustransaction
 *
 * @ORM\Table(name="BonusTransaction", indexes={@ORM\Index(name="IDX_7FB6636221CFA9F6", columns={"cmsUser"}), @ORM\Index(name="IDX_7FB66362BDAFD8C8", columns={"author"}), @ORM\Index(name="IDX_7FB663626DE44026", columns={"description"})})
 * @ORM\Entity
 */
class Bonustransaction
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdat;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer", nullable=false)
     */
    private $count;

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
     * @var \AppBundle\Entity\Cmsuser
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cmsuser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author", referencedColumnName="id")
     * })
     */
    private $author;

    /**
     * @var \AppBundle\Entity\Bonusreason
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Bonusreason")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="description", referencedColumnName="id")
     * })
     */
    private $description;

    /**
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * @param \DateTime $createdat
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
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
     * @return Cmsuser
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param Cmsuser $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return Bonusreason
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Bonusreason $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }



}

