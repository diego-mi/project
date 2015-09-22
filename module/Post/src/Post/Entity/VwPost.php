<?php

namespace Post\Entity;

use Doctrine\ORM\Mapping as ORM;
use Base\Entity\AbstractEntity;

/**
 * User
 *
 * @ORM\Table(name="vwposts")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Post\Entity\VwPostRepository")
 */
class VwPost extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="post_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $postId;

    /**
     * @var string
     *
     * @ORM\Column(name="post_content", type="text", nullable=true)
     */
    private $postContent;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_type", type="integer", nullable=false)
     */
    private $postType;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=100, nullable=false)
     */
    private $userName;

    /**
     * @return int
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param int $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPostContent()
    {
        return $this->postContent;
    }

    /**
     * @param string $postContent
     */
    public function setPostContent($postContent)
    {
        $this->postContent = $postContent;
        return $this;
    }

    /**
     * @return int
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * @param int $postType
     */
    public function setPostType($postType)
    {
        $this->postType = $postType;
        return $this;
    }

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
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }


}
