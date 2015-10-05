<?php

namespace Comment\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="vwcomment")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Comment\Entity\VwCommentRepository")
 */
class VwComment extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="comment_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $commentId;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_content", type="text", nullable=false)
     */
    private $commentContent;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_date", type="string", nullable=true)
     */
    private $commentDate;

    /**
     * @var int
     *
     * @ORM\Column(name="comment_post_id", type="integer", nullable=true)
     */
    private $commentPostId;

    /**
     * @var integer
     *
     * @ORM\Column(name="comment_author_id", type="integer", nullable=false)
     */
    private $commentAuthorId;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_author_name", type="string", nullable=true)
     */
    private $commentAuthorName;

    /**
     * @var string
     *
     * @ORM\Column(name="comment_author_picture", type="string", nullable=true)
     */
    private $commentAuthorPicture;

    /**
     * @return int
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @param int $commentId
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
    }

    /**
     * @return string
     */
    public function getCommentContent()
    {
        return $this->commentContent;
    }

    /**
     * @param string $commentContent
     */
    public function setCommentContent($commentContent)
    {
        $this->commentContent = $commentContent;
    }

    /**
     * @return string
     */
    public function getCommentDate()
    {
        return $this->commentDate;
    }

    /**
     * @param string $commentDate
     */
    public function setCommentDate($commentDate)
    {
        $this->commentDate = $commentDate;
    }

    /**
     * @return int
     */
    public function getCommentPostId()
    {
        return $this->commentPostId;
    }

    /**
     * @param int $commentPostId
     */
    public function setCommentPostId($commentPostId)
    {
        $this->commentPostId = $commentPostId;
    }

    /**
     * @return int
     */
    public function getCommentAuthorId()
    {
        return $this->commentAuthorId;
    }

    /**
     * @param int $commentAuthorId
     */
    public function setCommentAuthorId($commentAuthorId)
    {
        $this->commentAuthorId = $commentAuthorId;
    }

    /**
     * @return string
     */
    public function getCommentAuthorName()
    {
        return $this->commentAuthorName;
    }

    /**
     * @param string $commentAuthorName
     */
    public function setCommentAuthorName($commentAuthorName)
    {
        $this->commentAuthorName = $commentAuthorName;
    }

    /**
     * @return string
     */
    public function getCommentAuthorPicture()
    {
        return $this->commentAuthorPicture;
    }

    /**
     * @param string $commentAuthorPicture
     */
    public function setCommentAuthorPicture($commentAuthorPicture)
    {
        $this->commentAuthorPicture = $commentAuthorPicture;
    }
}
