<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Holiday
 *
 * @ORM\Table(name="Holiday", indexes={@ORM\Index(name="IDX_13278BA821CFA9F6", columns={"cmsUser"}), @ORM\Index(name="IDX_13278BA8BDAFD8C8", columns={"author"}), @ORM\Index(name="IDX_13278BA86DE44026", columns={"description"}), @ORM\Index(name="IDX_13278BA891B441F0", columns={"holidayType"})})
 * @ORM\Entity
 */
class Holiday
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date", nullable=false)
     */
    private $createdat;

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
     * @var \AppBundle\Entity\Holidaytype
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Holidaytype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="holidayType", referencedColumnName="id")
     * })
     */
    private $holidaytype;

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

    /**
     * @return Holidaytype
     */
    public function getHolidaytype()
    {
        return $this->holidaytype;
    }

    /**
     * @param Holidaytype $holidaytype
     */
    public function setHolidaytype($holidaytype)
    {
        $this->holidaytype = $holidaytype;
    }


    public function __construct()
    {
        $this->createdat = new \DateTime('now');
    }
}

