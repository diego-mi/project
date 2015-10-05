<?php

namespace Friend\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * View Following
 *
 * @ORM\Table(name="following")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Friend\Entity\FollowingRepository")
 */
class Following extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="follower_id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $followerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="following_id", type="integer", nullable=false)
     */
    private $followingId;

    /**
     * @var string
     *
     * @ORM\Column(name="following_name", type="string", length=100, nullable=false)
     */
    private $followingName;

    /**
     * @var string
     *
     * @ORM\Column(name="following_username", type="string", length=40, nullable=false)
     */
    private $followingUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="following_email", type="string", length=60, nullable=false)
     */
    private $followingEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="following_picture", type="string", length=100, nullable=true)
     */
    private $followingPicture;

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
     * @return int
     */
    public function getFollowingId()
    {
        return $this->followingId;
    }

    /**
     * @param int $followingId
     */
    public function setFollowingId($followingId)
    {
        $this->followingId = $followingId;
    }

    /**
     * @return string
     */
    public function getFollowingName()
    {
        return $this->followingName;
    }

    /**
     * @param string $followingName
     */
    public function setFollowingName($followingName)
    {
        $this->followingName = $followingName;
    }

    /**
     * @return string
     */
    public function getFollowingUsername()
    {
        return $this->followingUsername;
    }

    /**
     * @param string $followingUsername
     */
    public function setFollowingUsername($followingUsername)
    {
        $this->followingUsername = $followingUsername;
    }

    /**
     * @return string
     */
    public function getFollowingEmail()
    {
        return $this->followingEmail;
    }

    /**
     * @param string $followingEmail
     */
    public function setFollowingEmail($followingEmail)
    {
        $this->followingEmail = $followingEmail;
    }

    /**
     * @return string
     */
    public function getFollowingPicture()
    {
        return $this->followingPicture;
    }

    /**
     * @param string $followingPicture
     */
    public function setFollowingPicture($followingPicture)
    {
        $this->followingPicture = $followingPicture;
    }
}
