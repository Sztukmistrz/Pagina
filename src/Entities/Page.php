<?php

namespace Sztukmistrz\Pagina\Entities;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

use Sztukmistrz\Pagina\Entities\Traits\TitleAndSlugName;
use Sztukmistrz\Pagina\Entities\Traits\Blameable;
use Sztukmistrz\Pagina\Entities\Traits\Timestampable;

use Sztukmistrz\Pagina\Entities\Traits\Tree as TereeTrait;
/**
 * Page
 *
 * @Gedmo\Tree(type="nested")
 * 
 * @ORM\Table(name="pagina_Pages", options={"comment"="komentarz..."}, uniqueConstraints={@ORM\UniqueConstraint(name="ID", columns={"id"})}, indexes={@ORM\Index(name="NAME", columns={"name"})})
 * @ORM\Entity(repositoryClass="Sztukmistrz\Pagina\Entities\Repositories\Page")
 */
class Page  implements Translatable
{

    use TitleAndSlugName, Blameable, Timestampable, TereeTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", length=11, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * @var \Sztukmistrz\Pagina\Entities\Layout
     *
     * @ORM\ManyToOne(targetEntity="Sztukmistrz\Pagina\Entities\Layout", inversedBy="page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="layout_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $layout;

    /**
     * @var \Sztukmistrz\Pagina\Entities\User
     *
     * @ORM\ManyToOne(targetEntity="Entities\Passport\User", inversedBy="page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $user;

    /**
     * @var \Sztukmistrz\Pagina\Entities\View
     *
     * @ORM\ManyToOne(targetEntity="Sztukmistrz\Pagina\Entities\View", inversedBy="page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="view_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $view;

    /**
     * @var \Sztukmistrz\Pagina\Entities\RouteName
     *
     * @ORM\ManyToOne(targetEntity="Sztukmistrz\Pagina\Entities\RouteName", inversedBy="page")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="route_name_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $routeName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sztukmistrz\Pagina\Entities\PageText", inversedBy="page")
     * @ORM\JoinTable(name="pagina_PageTextToPage",
     *   joinColumns={
     *     @ORM\JoinColumn(name="page_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="page_text_id", referencedColumnName="id", nullable=false)
     *   }
     * )
     */
    private $pageText;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Sztukmistrz\Pagina\Entities\Menu", mappedBy="page")
     */
    private $menu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pageText = new \Doctrine\Common\Collections\ArrayCollection();
        $this->menu = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set routeName
     *
     * @param \Sztukmistrz\Pagina\Entities\RouteName $routeName
     *
     * @return Page
     */
    public function setRouteName(\Sztukmistrz\Pagina\Entities\RouteName $routeName)
    {
        $this->routeName = $routeName;

        return $this;
    }

    /**
     * Get routeName
     *
     * @return \Sztukmistrz\Pagina\Entities\RouteName
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * Set layout
     *
     * @param \Sztukmistrz\Pagina\Entities\Layout $layout
     *
     * @return Page
     */
    public function setLayout(\Sztukmistrz\Pagina\Entities\Layout $layout = null)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get layout
     *
     * @return \Sztukmistrz\Pagina\Entities\Layout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set user
     *
     * @param \Entities\Passport\User $user
     *
     * @return Page
     */
    public function setUser(\Entities\Passport\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Entities\Passport\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add pageText
     *
     * @param \Sztukmistrz\Pagina\Entities\PageText $pageText
     *
     * @return Page
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

    /**
     * Add menu
     *
     * @param \Sztukmistrz\Pagina\Entities\Menu $menu
     *
     * @return Page
     */
    public function addMenu(\Sztukmistrz\Pagina\Entities\Menu $menu)
    {
        // SUPER! 
        $menu->addPage($this);
        
        $this->menu[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param \Sztukmistrz\Pagina\Entities\Menu $menu
     */
    public function removeMenu(\Sztukmistrz\Pagina\Entities\Menu $menu)
    {
        $this->menu->removeElement($menu);
    }

    /**
     * Get menu
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set view
     *
     * @param \Sztukmistrz\Pagina\Entities\View $view
     *
     * @return Page
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
}

