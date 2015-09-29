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
    protected $arrPrivacity = array(
        1 => 'fa-pencil',
        2 => 'fa-pencil',
    );
    protected $arrClassification = array(
        1 => 'fa-pencil',
        2 => 'fa-pencil',
    );

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
     * @var string
     *
     * @ORM\Column(name="post_date", type="string", nullable=true)
     */
    private $postDate;


    /**
     * @var integer
     *
     * @ORM\Column(name="post_classification", type="integer", nullable=true)
     */
    private $postClassification;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_privacity", type="integer", nullable=true)
     */
    private $postPrivacity;

    /**
     * @var string
     *
     * @ORM\Column(name="post_type_name", type="string", length=50, nullable=false)
     */
    private $postTypeName;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_type_id", type="integer", nullable=false)
     */
    private $postTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="post_picture", type="string", nullable=true)
     */
    private $postPicture;

    /**
     * @var string
     *
     * @ORM\Column(name="user_picture", type="string", nullable=true)
     */
    private $userPicture;

    /**
     * @var int
     *
     * @ORM\Column(name="post_gostei", type="integer", nullable=true)
     */
    private $postGostei;


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

    /**
     * @return date
     */
    public function getPostDate()
    {
        return date('d/m - H:i', strtotime($this->postDate));
    }

    /**
     * @param date $postDate
     */
    public function setPostDate($postDate)
    {
        $this->postDate = $postDate;
    }

    /**
     * @return int
     */
    public function getPostClassification()
    {
        return $this->arrClassification[$this->postClassification];
    }

    /**
     * @param int $postClassification
     */
    public function setPostClassification($postClassification)
    {
        $this->postClassification = $postClassification;
    }

    /**
     * @return int
     */
    public function getPostPrivacity()
    {
        return $this->arrPrivacity[$this->postPrivacity];
    }

    /**
     * @param int $postPrivacity
     */
    public function setPostPrivacity($postPrivacity)
    {
        $this->postPrivacity = $postPrivacity;
    }

    /**
     * @return string
     */
    public function getPostTypeName()
    {
        return $this->postTypeName;
    }

    /**
     * @param string $postTypeName
     */
    public function setPostTypeName($postTypeName)
    {
        $this->postTypeName = $postTypeName;
    }

    /**
     * @return int
     */
    public function getPostTypeId()
    {
        return $this->postTypeId;
    }

    /**
     * @param int $postTypeId
     */
    public function setPostTypeId($postTypeId)
    {
        $this->postTypeId = $postTypeId;
    }

    /**
     * @return string
     */
    public function getPostPicture()
    {
        return $this->postPicture;
    }

    /**
     * @param string $postPicture
     */
    public function setPostPicture($postPicture)
    {
        $this->postPicture = $postPicture;
    }

    /**
     * @return string
     */
    public function getUserPicture()
    {
        return $this->userPicture;
    }

    /**
     * @param string $userPicture
     */
    public function setUserPicture($userPicture)
    {
        $this->userPicture = $userPicture;
    }

    /**
     * @return int
     */
    public function getPostGostei()
    {
        return $this->postGostei;
    }

    /**
     * @param int $postGostei
     */
    public function setPostGostei($postGostei)
    {
        $this->postGostei = $postGostei;
    }
}
