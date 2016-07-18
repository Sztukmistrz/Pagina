<?php

namespace Sztukmistrz\Pagina\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Sztukmistrz\Pagina\Entities\Traits\Blameable;
use Sztukmistrz\Pagina\Entities\Traits\Timestampable;

/**
 * Layout
 *
 * @ORM\Table(name="layouts", uniqueConstraints={@ORM\UniqueConstraint(name="ID", columns={"id"})}, indexes={@ORM\Index(name="NAME", columns={"name"})})
 * @ORM\Entity(repositoryClass="Sztukmistrz\Pagina\Entities\Repositories\Layout")
 */
class Layout
{
    use  Blameable, Timestampable;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", length=11, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(
     *     name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false, 
     *     options={
     *     "helpBlock":"Nazwa istniejącego layoutu."
     *     }
     * )
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Sztukmistrz\Pagina\Entities\Page", mappedBy="layout")
     */
    private $page;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->page = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Layout
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
     * Add page
     *
     * @param \Sztukmistrz\Pagina\Entities\Page $page
     *
     * @return Layout
     */
    public function addPage(\Sztukmistrz\Pagina\Entities\Page $page)
    {
        $this->page[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \Sztukmistrz\Pagina\Entities\Page $page
     */
    public function removePage(\Sztukmistrz\Pagina\Entities\Page $page)
    {
        $this->page->removeElement($page);
    }

    /**
     * Get page
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPage()
    {
        return $this->page;
    }
}

