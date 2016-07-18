<?php

namespace Sztukmistrz\Pagina\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * RouteName
 *
 * @ORM\Table(name="pagina_RouteName", uniqueConstraints={@ORM\UniqueConstraint(name="ID", columns={"id"})})
 * @ORM\Entity(repositoryClass="Sztukmistrz\Pagina\Entities\Repositories\RouteName")
 */
class RouteName
{
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
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false, 
     *     options={
     *     "helpBlock":"Nazwa istniejącej route. Trzeba uzupełnić pliki config navigatora i seo"
     *     }
     * )
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Sztukmistrz\Pagina\Entities\Page", mappedBy="routeName")
     */
    private $page;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sztukmistrz\Pagina\Entities\PageText", mappedBy="routeName")
     */
    private $pageText;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->page = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return RouteName
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
     * @return RouteName
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

    /**
     * Add pageText
     *
     * @param \Sztukmistrz\Pagina\Entities\PageText $pageText
     *
     * @return RouteName
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

