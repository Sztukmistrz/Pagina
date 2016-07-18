<?php

namespace Sztukmistrz\Pagina\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use Sztukmistrz\Pagina\Entities\Traits\Blameable;
use Sztukmistrz\Pagina\Entities\Traits\Timestampable;

/**
 * Menu
 *
 * @ORM\Table(name="pagina_Menus", options={"comment"="komentarz..."}, uniqueConstraints={@ORM\UniqueConstraint(name="ID", columns={"id"})}, indexes={@ORM\Index(name="NAME", columns={"name"})})
 * @ORM\Entity(repositoryClass="Sztukmistrz\Pagina\Entities\Repositories\Menu")
 */
class Menu
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
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sztukmistrz\Pagina\Entities\Page", inversedBy="menu")
     * @ORM\JoinTable(name="pagina_PageToMenu",
     *   joinColumns={
     *     @ORM\JoinColumn(name="menu_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="page_id", referencedColumnName="id", nullable=false)
     *   }
     * )
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
     * @return Menu
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
     * @return Menu
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

