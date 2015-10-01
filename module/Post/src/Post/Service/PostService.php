<?php
namespace Post\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator\ClassMethods;

class PostService
{

    protected $em;
    protected $entity;

    public function __construct(EntityManager $em)
    {
        $this->entity = 'Post\Entity\Post';
        $this->em = $em;
    }

    public function save($data)
    {
        if ((isset($data['id'])) && (!empty($data['id']))) {
            $entity = $this->em->getReference($this->entity, $data['id']);

            $hydrator = new ClassMethods();
            $hydrator->hydrate($data, $entity);

        } else {
            $entity = new $this->entity($data);
        }

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    /**
     * @param array $data
     *
     * @param int $userId
     * @param array $data
     *
     * @return object
     */
    public function insert($data, $userId)
    {
        $data['authorId'] = $userId;
        if ((count($data['picture'])) && (!empty($data['picture']['tmp_name']))) {
            $data['picture'] = $this->getNewNameFileUpload($data['picture']['tmp_name']);
        } else {
            unset($data['picture']);
        }

        return $this->save($data);
    }

    /**
     * @param string $tmpName Nome temporario do arquivo que foi upado
     */
    protected function getNewNameFileUpload($tmpName)
    {
        $tmpNameFull = explode("_", $tmpName);

        return $tmpNameFull[1];
    }

    public function getPostsFeed($intUserViewer)
    {
        $arrFollowingIds = $this->getFollowingIds($intUserViewer);
        array_push($arrFollowingIds, $intUserViewer);
        $posts = $this->em->getRepository('Post\Entity\VwPost')->findBy(
            array(
                'userId' => $arrFollowingIds,
            ),
            array('postId' => 'DESC'
            )
        );
        $listPostId = '';
        foreach ($posts as $post) {
            $listPostId[] = $post->getPostId();
        }

        $listPostId = implode(',', $listPostId);
        $postsGostei = $this->em->getRepository('Gostei\Entity\Gostei')->getGostei($listPostId, $intUserViewer);
        return array('posts' => $posts, 'gostei' => $postsGostei);
    }

    public function getPostsProfile($intUserViewer)
    {
        $posts = $this->em->getRepository('Post\Entity\VwPost')->findBy(
            array(
                'userId' => $intUserViewer,
            ),
            array('postId' => 'DESC'
            )
        );
        $listPostId = '';
        foreach ($posts as $post) {
            $listPostId[] = $post->getPostId();
        }

        $listPostId = implode(',', $listPostId);
        $postsGostei = $this->em->getRepository('Gostei\Entity\Gostei')->getGostei($listPostId, $intUserViewer);
        return array('posts' => $posts, 'gostei' => $postsGostei);
    }

    protected function getFollowingIds($intUserViewer) {
        $arrFollowing =  $this->em->getRepository('Friend\Entity\Following')->findBy(
            array(
                'followerId' => $intUserViewer
            ),
            array(
                'followingName' => 'ASC'
            ),
            10
        );
        $arrFollowingIds = array();
        foreach ($arrFollowing as $following => $key) {
            $arrFollowingIds[] = $key->getFollowingId();
        }
        return $arrFollowingIds;
    }

}