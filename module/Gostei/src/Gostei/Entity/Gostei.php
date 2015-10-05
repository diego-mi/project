<?php

namespace Gostei\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="gostei")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Gostei\Entity\GosteiRepository")
 */
class Gostei extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $userId;

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
     * @ORM\Column(name="post_author_id", type="integer", nullable=false)
     */
    private $postAuthorId;

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

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
        return $this;
    }

    /**
     * @return int
     */
    public function getPostAuthorId()
    {
        return $this->postAuthorId;
    }

    /**
     * @param int $postAuthorId
     */
    public function setPostAuthorId($postAuthorId)
    {
        $this->postAuthorId = $postAuthorId;
    }
}
