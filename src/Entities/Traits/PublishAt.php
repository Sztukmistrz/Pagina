<?php
namespace Sztukmistrz\Pagina\Entities\Traits;
use Doctrine\ORM\Mapping AS ORM;
use DateTime;

trait PublishAt
{

    /**
     * @var string
     *
     * @ORM\Column(name="publish_at", type="datetime", precision=0, scale=0, nullable=true, unique=false)
     */
    private $publishAt;

//options={"default" = "0000-00-00 00:00:00"}

    /**
     * Set publishAt
     *
     * @param string $publishAt
     *
     * @return Volume
     */
    public function setPublishAt($publishAt)
    {
        
        // if (!$publishAt) {
        //     $this->publishAt = null;//'0000-00-00 00:00:00';
        // }
        // else{
        //      $this->publishAt = $publishAt;
        // }
        $this->publishAt = $publishAt;
        
        return $this;
    }

    /**
     * Get publishAt
     *
     * @return string
     */
    public function getPublishAt()
    {
        //  return new DateTime('1000-01-01');
        // //return new DateTime('2000-01-01');
        // if (!$this->publishAt) {
        //     return new DateTime('2000-01-01');
        // }
         return $this->publishAt;
    }
}