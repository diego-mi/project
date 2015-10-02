<?php

namespace Friend\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * View Friend
 *
 * @ORM\Table(name="vwfriend")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Friend\Entity\VwFriendRepository")
 */
class VwFriend extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="friend_id", type="integer", nullable=false)
     */
    private $friendId;

    /**
     * @var string
     *
     * @ORM\Column(name="friend_name", type="string", length=100, nullable=false)
     */
    private $friendName;

    /**
     * @var string
     *
     * @ORM\Column(name="friend_username", type="string", length=40, nullable=false)
     */
    private $friendUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="friend_email", type="string", length=60, nullable=false)
     */
    private $friendEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="friend_picture", type="string", length=100, nullable=true)
     */
    private $friendPicture;

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
    }

    /**
     * @return int
     */
    public function getFriendId()
    {
        return $this->friendId;
    }

    /**
     * @param int $friendId
     */
    public function setFriendId($friendId)
    {
        $this->friendId = $friendId;
    }

    /**
     * @return string
     */
    public function getFriendName()
    {
        return $this->friendName;
    }

    /**
     * @param string $friendName
     */
    public function setFriendName($friendName)
    {
        $this->friendName = $friendName;
    }

    /**
     * @return string
     */
    public function getFriendUsername()
    {
        return $this->friendUsername;
    }

    /**
     * @param string $friendUsername
     */
    public function setFriendUsername($friendUsername)
    {
        $this->friendUsername = $friendUsername;
    }

    /**
     * @return string
     */
    public function getFriendEmail()
    {
        return $this->friendEmail;
    }

    /**
     * @param string $friendEmail
     */
    public function setFriendEmail($friendEmail)
    {
        $this->friendEmail = $friendEmail;
    }

    /**
     * @return string
     */
    public function getFriendPicture()
    {
        return $this->friendPicture;
    }

    /**
     * @param string $friendPicture
     */
    public function setFriendPicture($friendPicture)
    {
        $this->friendPicture = $friendPicture;
    }
}
