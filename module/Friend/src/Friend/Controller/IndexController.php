<?php
namespace Friend\Controller;

use Base\Controller\AbstractController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractController
{

    /**
     *
     */
    function __construct()
    {
        $this->form = 'Friend\Form\FriendForm';
        $this->controller = 'friend';
        $this->route = 'friend/default';
        $this->service = 'Friend\Service\FriendService';
        $this->entity = 'Friend\Entity\Friend';
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $data = array();
        $post = $this->getRequest()->getPost()->toArray();
        $data['friendId'] = $post['friendid'];
        $data['userId'] = $this->identity()->getId();
        $service = $this->getServiceLocator()->get($this->service);

        $result = $service->friend($data);
        return new JsonModel(array('status' => $result));
    }

    public function verSeguindoAction()
    {
        $friends = $this->getEm()->getRepository('Friend\Entity\Following')->findBy(
            array(
                'followerId' => $this->identity()->getId()
            ),
            array(
                'followingName' => 'ASC'
            ),
            10
        );
        return new ViewModel(array('friends' => $friends));
    }


    public function verSeguindoSearchAction()
    {
        $strName = $this->params()->fromRoute('id');
        $friends = $this->getEm()->getRepository('Profile\Entity\Profile')->searchByName($strName);
        return new ViewModel(array('friends' => $friends));
    }



    public function verSeguidoresAction()
    {

        $friends = $this->getEm()->getRepository('Friend\Entity\Followers')->findBy(
            array(
                'followingId' => $this->identity()->getId()
            ),
            array(
                'followerName' => 'ASC'
            ),
            10
        );
        return new ViewModel(array('friends' => $friends));
    }
}
