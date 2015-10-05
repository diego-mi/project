<?php

namespace Friend\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * View Followers
 *
 * @ORM\Table(name="followers")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Friend\Entity\FollowersRepository")
 */
class Followers extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="following_id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $followingId;

    /**
     * @var integer
     *
     * @ORM\Column(name="follower_id", type="integer", nullable=false)
     */
    private $followerId;

    /**
     * @var string
     *
     * @ORM\Column(name="follower_name", type="string", length=100, nullable=false)
     */
    private $followerName;

    /**
     * @var string
     *
     * @ORM\Column(name="follower_username", type="string", length=40, nullable=false)
     */
    private $followerUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="follower_email", type="string", length=60, nullable=false)
     */
    private $followerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="follower_picture", type="string", length=100, nullable=true)
     */
    private $followerPicture;

    /**
     * @return int
     */
    public function getFollowingId()
    {
        return $this->followingId;
    }

    /**
     * @param int $followerId
     */
    public function setFollowingId($followingId)
    {
        $this->followerId = $followingId;
    }

    /**
     * @return int
     */
    public function getFollowerId()
    {
        return $this->followerId;
    }

    /**
     * @param int $followerId
     */
    public function setFollowerId($followerId)
    {
        $this->followerId = $followerId;
    }

    /**
     * @return string
     */
    public function getFollowerName()
    {
        return $this->followerName;
    }

    /**
     * @param string $followerName
     */
    public function setFollowerName($followerName)
    {
        $this->followerName = $followerName;
    }

    /**
     * @return string
     */
    public function getFollowerUsername()
    {
        return $this->followerUsername;
    }

    /**
     * @param string $followerUsername
     */
    public function setFollowerUsername($followerUsername)
    {
        $this->followerUsername = $followerUsername;
    }

    /**
     * @return string
     */
    public function getFollowerEmail()
    {
        return $this->followerEmail;
    }

    /**
     * @param string $followerEmail
     */
    public function setFollowerEmail($followerEmail)
    {
        $this->followerEmail = $followerEmail;
    }

    /**
     * @return string
     */
    public function getFollowerPicture()
    {
        return $this->followerPicture;
    }

    /**
     * @param string $followerPicture
     */
    public function setFollowerPicture($followerPicture)
    {
        $this->followerPicture = $followerPicture;
    }
}
