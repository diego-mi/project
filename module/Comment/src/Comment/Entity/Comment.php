<?php

namespace Comment\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Comment\Entity\CommentRepository")
 */
class Comment extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", nullable=true)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="post_id", type="integer", nullable=true)
     */
    private $postId;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_author_id", type="integer", nullable=false)
     */
    private $postAuthorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="action_author_id", type="integer", nullable=false)
     */
    private $actionAuthorId;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

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

    /**
     * @return int
     */
    public function getActionAuthorId()
    {
        return $this->actionAuthorId;
    }

    /**
     * @param int $actionAuthorId
     */
    public function setActionAuthorId($actionAuthorId)
    {
        $this->actionAuthorId = $actionAuthorId;
    }
}
