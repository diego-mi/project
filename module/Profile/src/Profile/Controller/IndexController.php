<?php
namespace Profile\Controller;

use Base\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{

    /**
     *
     */
    function __construct()
    {
        $this->form = 'Profile\Form\ProfileForm';
        $this->controller = 'profile';
        $this->route = 'profile/default';
        $this->service = 'Profile\Service\ProfileService';
        $this->entity = 'Profile\Entity\VwProfile';
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $list = $this->getEm()->getRepository($this->entity)->findBy(array(), array('postId' => 'DESC'));
        $this->form = $this->getServiceLocator()->get($this->form);

        return new ViewModel(array('list' => $list, 'form' => $this->form));
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function inserirAction()
    {
        $this->form = $this->getServiceLocator()->get($this->form);

        return parent::editarAction();
    }

    /**
     * @return ViewModel
     */
    public function editarAction()
    {
        $this->form = $this->getServiceLocator()->get($this->form);

        return parent::editarAction();
    }
}
