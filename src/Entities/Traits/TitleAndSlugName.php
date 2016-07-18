<?php
namespace Sztukmistrz\Pagina\Entities\Traits;
use Doctrine\ORM\Mapping AS ORM;

trait TitleAndSlugName
{

	/**
     * @Gedmo\Translatable
     * @ORM\Column(type="string", length=255, nullable=true, name="title")
     */
    private $title;


    /**
     * @Gedmo\Translatable
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255, unique=true)
     */
    protected $name;



    /**
     * Set title
     *
     * @param string $title
     *
     * @return Ent
     */
    public function setTitle($title)
    {
    $this->title = $title;

    return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
    return $this->title;
    }


    /**
     * Get titleSlug
     *
     * @return string
     */
    public function getTitleSlug()
    {
    return $this->titleSlug;
    }



}