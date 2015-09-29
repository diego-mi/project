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
        $data['postId'] = $this->params()->fromRoute('postid');
        $data['userId'] = $this->identity()->getId();
        $service = $this->getServiceLocator()->get($this->service);

        if ($service->insert($data)) {
            return new JsonModel(array('status' => true));
        }
        return new JsonModel(array('status' => false));
    }

}
