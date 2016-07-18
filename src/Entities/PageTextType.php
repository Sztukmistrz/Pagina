<?php

namespace Sztukmistrz\Pagina\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageTextType
 *
 * @ORM\Table(name="pagina_PageTextType", options={"comment"="komentarz..."})
 * @ORM\Entity(repositoryClass="Sztukmistrz\Pagina\Entities\Repositories\PageTextType")
 */
class PageTextType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Sztukmistrz\Pagina\Entities\PageText", mappedBy="pageTextType")
     */
    private $pageText;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pageText = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PageTextType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add pageText
     *
     * @param \Sztukmistrz\Pagina\Entities\PageText $pageText
     *
     * @return PageTextType
     */
    public function addPageText(\Sztukmistrz\Pagina\Entities\PageText $pageText)
    {
        $this->pageText[] = $pageText;

        return $this;
    }

    /**
     * Remove pageText
     *
     * @param \Sztukmistrz\Pagina\Entities\PageText $pageText
     */
    public function removePageText(\Sztukmistrz\Pagina\Entities\PageText $pageText)
    {
        $this->pageText->removeElement($pageText);
    }

    /**
     * Get pageText
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPageText()
    {
        return $this->pageText;
    }
}

