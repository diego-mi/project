<?php
namespace Register\Controller;

use Base\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{

    /**
     * __construct
     */
    function __construct()
    {
        $this->form = 'Register\Form\RegisterForm';
        $this->controller = 'register';
        $this->route = 'register/default';
        $this->service = 'Register\Service\RegisterService';
        $this->entity = 'Register\Entity\User';
    }

    public function indexAction()
    {
        $this->layout('layout/register');
        $form = $this->form = $this->getServiceLocator()->get($this->form);
        $form->prepareElements();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                var_dump($form->getData());
                if ($service->register($form->getData())) {
                    var_dump(true);
                }
            }
        }
        return new ViewModel(array('form' => $form));
    }

}
