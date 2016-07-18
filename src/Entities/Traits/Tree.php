<?php
namespace Sztukmistrz\Pagina\Entities\Traits;
use Doctrine\ORM\Mapping AS ORM;

trait Tree
{
    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Sztukmistrz\Pagina\Entities\Page")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Sztukmistrz\Pagina\Entities\Page", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Sztukmistrz\Pagina\Entities\Page", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    

    public function getRoot()
    {
        return $this->root;
    }

    // public function setRoot($root)
    // {
    //     return $this->root = $root;
    // }

    public function setParent(\Sztukmistrz\Pagina\Entities\Page $parent = null)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }


}