<?php
namespace Profile\Entity;

use Base\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Post\Entity\PostRepository")
 */
class Profile extends AbstractEntity

}