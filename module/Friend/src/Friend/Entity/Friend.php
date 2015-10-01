<?php
namespace Friend\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Profile
 *
 * @ORM\Table(name="friend")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Friend\Entity\FriendRepository")
 */
class Friend extends AbstractEntity
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
     * @ORM\Id
     */
    private $friendId;

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
}