<?php
namespace Post\Controller;

use Base\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{

    /**
     *
     */
    function __construct()
    {
        $this->form = 'Post\Form\PostForm';
        $this->controller = 'post';
        $this->route = 'post/default';
        $this->service = 'Post\Service\PostService';
        $this->entity = 'Post\Entity\VwPost';
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $list = $this->getEm()->getRepository($this->entity)->findBy(array(), array('postId' => 'DESC'));
        $form = $this->getServiceLocator()->get($this->form);
        return new ViewModel(array('list' => $list, 'form'=> $form));
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function inserirAction()
    {
        //$this->form = $this->getServiceLocator()->get($this->form);

        return parent::inserirAction();
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
