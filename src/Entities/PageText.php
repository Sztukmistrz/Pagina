<?php

namespace Sztukmistrz\Pagina\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

use Sztukmistrz\Pagina\Entities\Traits\TitleAndSlugName;
use Sztukmistrz\Pagina\Entities\Traits\Blameable;
use Sztukmistrz\Pagina\Entities\Traits\Timestampable;

/**
 * PageText
 *
 * @ORM\Table(name="pagina_PageTexts", options={"comment"="komentarz..."}, uniqueConstraints={@ORM\UniqueConstraint(name="ID", columns={"id"})}, indexes={@ORM\Index(name="NAME", columns={"name"}), @ORM\Index(name="TYPE", columns={"page_text_type_id"})})
 * @ORM\Entity(repositoryClass="Sztukmistrz\Pagina\Entities\Repositories\PageText")
 */
class PageText  implements Translatable
{

    use TitleAndSlugName, Blameable, Timestampable;

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
     * @Gedmo\Translatable
     * @ORM\Column(name="text", type="text", precision=0, scale=0, nullable=false, unique=false)
     */
    private $text;

    /**
     * @var \Sztukmistrz\Pagina\Entities\PageTextType
     *
     * @ORM\ManyToOne(targetEntity="Sztukmistrz\Pagina\Entities\PageTextType", inversedBy="pageText")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="page_text_type_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $pageTextType;

    /**
     * @var \Sztukmistrz\Pagina\Entities\View
     *
     * @ORM\ManyToOne(targetEntity="Sztukmistrz\Pagina\Entities\View", inversedBy="pageText")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="view_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $view;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sztukmistrz\Pagina\Entities\RouteName", inversedBy="pageText")
     * @ORM\JoinTable(name="pagina_RouteNameToPageText",
     *   joinColumns={
     *     @ORM\JoinColumn(name="page_text_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="route_name_id", referencedColumnName="id", nullable=false)
     *   }
     * )
     */
    private $routeName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sztukmistrz\Pagina\Entities\Page", mappedBy="pageText")
     */
    private $page;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->routeName = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set text
     *
     * @param string $text
     *
     * @return PageText
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set pageTextType
     *
     * @param \Sztukmistrz\Pagina\Entities\PageTextType $pageTextType
     *
     * @return PageText
     */
    public function setPageTextType(\Sztukmistrz\Pagina\Entities\PageTextType $pageTextType)
    {
        $this->pageTextType = $pageTextType;

        return $this;
    }

    /**
     * Get pageTextType
     *
     * @return \Sztukmistrz\Pagina\Entities\PageTextType
     */
    public function getPageTextType()
    {
        return $this->pageTextType;
    }

    /**
     * Set view
     *
     * @param \Sztukmistrz\Pagina\Entities\View $view
     *
     * @return PageText
     */
    public function setView(\Sztukmistrz\Pagina\Entities\View $view = null)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get view
     *
     * @return \Sztukmistrz\Pagina\Entities\View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Add routeName
     *
     * @param \Sztukmistrz\Pagina\Entities\RouteName $routeName
     *
     * @return PageText
     */
    public function addRouteName(\Sztukmistrz\Pagina\Entities\RouteName $routeName)
    {
        $this->routeName[] = $routeName;

        return $this;
    }

    /**
     * Remove routeName
     *
     * @param \Sztukmistrz\Pagina\Entities\RouteName $routeName
     */
    public function removeRouteName(\Sztukmistrz\Pagina\Entities\RouteName $routeName)
    {
        $this->routeName->removeElement($routeName);
    }

    /**
     * Get routeName
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRouteName()
    {
        return $this->routeName;
    }
    
    /**
     * Add page
     *
     * @param \Sztukmistrz\Pagina\Entities\Page $page
     *
     * @return PageText
     */
    public function addPage(\Sztukmistrz\Pagina\Entities\Page $page)
    {
        $page = $page->addPageText($this);

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

