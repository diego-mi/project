<?php
namespace Friend\Controller;

use Base\Controller\AbstractController;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractController
{

    /**
     *
     */
    function __construct()
    {
        $this->form = 'Friend\Form\FriendForm';
        $this->controller = 'Friend';
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
        $data['postId'] = $post['postid'];
        $data['userId'] = $this->identity()->getId();
        $service = $this->getServiceLocator()->get($this->service);

        $result = $service->gostei($data);
        //if ($service->gostei($data)) {
          //  return new JsonModel(array('status' => true));
        //}
        return new JsonModel(array('status' => $result));
    }
}
