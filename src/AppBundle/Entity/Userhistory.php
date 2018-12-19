<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Userhistory
 *
 * @ORM\Table(name="UserHistory", indexes={@ORM\Index(name="IDX_F2FA3ABE21CFA9F6", columns={"cmsUser"})})
 * @ORM\Entity
 */
class Userhistory
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=64, nullable=true)
     */
    private $description;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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

