<?php

namespace Gostei\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="vwgosteicount")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Gostei\Entity\VwGosteiCountRepository")
 */
class VwGosteiCount extends AbstractEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="post_id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $postId;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_gostei_count", type="integer", nullable=false)
     */
    private $postGosteiCount;

    /**
     * @return string
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param string $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    /**
     * @return int
     */
    public function getPostGosteiCount()
    {
        return $this->postGosteiCount;
    }

    /**
     * @param int $postGosteiCount
     */
    public function setPostGosteiCount($postGosteiCount)
    {
        $this->postGosteiCount = $postGosteiCount;
    }
}
