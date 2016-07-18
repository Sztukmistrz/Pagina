<?php
namespace Sztukmistrz\Pagina\Entities\Traits;
use Doctrine\ORM\Mapping AS ORM;

trait Blameable
{

    /**
     * @var string $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\Column(type="string")
     */
    protected $createdBy;

    /**
     * @var string $updatedBy
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\Column(type="string")
     */
    protected $updatedBy;





    /**
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }



    /**
     * Get updatedBy
     *
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }


}