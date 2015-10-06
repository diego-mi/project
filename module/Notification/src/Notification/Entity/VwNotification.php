<?php

namespace Notification\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * View Notification
 *
 * @ORM\Table(name="vwnotification")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Notification\Entity\VwNotificationRepository")
 */
class VwNotification extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="notification_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $notificationId;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_date", type="string", nullable=true)
     */
    private $notificationDate;

    /**
     * @var int
     *
     * @ORM\Column(name="notification_post_id", type="integer", nullable=true)
     */
    private $notificationPostId;

    /**
     * @var int
     *
     * @ORM\Column(name="notification_post_author_id", type="integer", nullable=true)
     */
    private $notificationPostAuthorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="notification_author_id", type="integer", nullable=false)
     */
    private $notificationAuthorId;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_author_name", type="string", nullable=true)
     */
    private $notificationAuthorName;

    /**
     * @var string
     *
     * @ORM\Column(name="notification_author_picture", type="string", nullable=true)
     */
    private $notificationAuthorPicture;

    /**
     * @return int
     */
    public function getNotificationId()
    {
        return $this->notificationId;
    }

    /**
     * @param int $notificationId
     */
    public function setNotificationId($notificationId)
    {
        $this->notificationId = $notificationId;
    }

    /**
     * @return string
     */
    public function getNotificationDate()
    {
        return $this->notificationDate;
    }

    /**
     * @param string $notificationDate
     */
    public function setNotificationDate($notificationDate)
    {
        $this->notificationDate = $notificationDate;
    }

    /**
     * @return int
     */
    public function getNotificationPostId()
    {
        return $this->notificationPostId;
    }

    /**
     * @param int $notificationPostId
     */
    public function setNotificationPostId($notificationPostId)
    {
        $this->notificationPostId = $notificationPostId;
    }

    /**
     * @return int
     */
    public function getNotificationPostAuthorId()
    {
        return $this->notificationPostAuthorId;
    }

    /**
     * @param int $notificationPostAuthorId
     */
    public function setNotificationPostAuthorId($notificationPostAuthorId)
    {
        $this->notificationPostAuthorId = $notificationPostAuthorId;
    }

    /**
     * @return int
     */
    public function getNotificationAuthorId()
    {
        return $this->notificationAuthorId;
    }

    /**
     * @param int $notificationAuthorId
     */
    public function setNotificationAuthorId($notificationAuthorId)
    {
        $this->notificationAuthorId = $notificationAuthorId;
    }

    /**
     * @return string
     */
    public function getNotificationAuthorName()
    {
        return $this->notificationAuthorName;
    }

    /**
     * @param string $notificationAuthorName
     */
    public function setNotificationAuthorName($notificationAuthorName)
    {
        $this->notificationAuthorName = $notificationAuthorName;
    }

    /**
     * @return string
     */
    public function getNotificationAuthorPicture()
    {
        return $this->notificationAuthorPicture;
    }

    /**
     * @param string $notificationAuthorPicture
     */
    public function setNotificationAuthorPicture($notificationAuthorPicture)
    {
        $this->notificationAuthorPicture = $notificationAuthorPicture;
    }
}
