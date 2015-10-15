<?php

namespace Comment\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="vwcommentcount")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Comment\Entity\VwCommentCountRepository")
 */
class VwCommentCount extends AbstractEntity
{

    /**
     * @var int
     *
     * @ORM\Column(name="post_id", type="integer", nullable=true)
     * @ORM\Id
     */
    private $postId;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_comment_count", type="integer", nullable=false)
     */
    private $postCommentCount;

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
    public function getPostCommentCount()
    {
        return $this->postCommentCount;
    }

    /**
     * @param int $postCommentCount
     */
    public function setPostCommentCount($postCommentCount)
    {
        $this->postCommentCount = $postCommentCount;
    }


}
