<?php
namespace Gostei\Controller;

use Base\Controller\AbstractController;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractController
{

    /**
     *
     */
    function __construct()
    {
        $this->form = 'Gostei\Form\GosteiForm';
        $this->controller = 'Gostei';
        $this->route = 'gostei/default';
        $this->service = 'Gostei\Service\GosteiService';
        $this->entity = 'Gostei\Entity\Gostei';
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $data = array();
        $post = $this->getRequest()->getPost()->toArray();
        $data['postId'] = $post['postid'];
        $data['actionAuthorId'] = $this->identity()->getId();
        $service = $this->getServiceLocator()->get($this->service);

        $result = $service->gostei($data);
        $count = $service->count($data['postId']);
        return new JsonModel(array('status' => $result, 'count'=>$count));
    }
}
