<?php

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Auth\Form\FormLogin;

class AuthController extends AbstractActionController
{
    public function loginAction()
    {
        $this->layout('layout/login');
        $form = new FormLogin();
        $form->prepareElements();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            if ($form->isValid()) {
                $data = $form->getData();
                $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                $adapter = $auth->getAdapter();
                $adapter->setUsername($data['username'])->setPassword($data['password']);
                if ($auth->authenticate()->isValid()) {
                    return $this->redirect()->toRoute(
                        'post',
                        array(
                            'controller' => 'post',
                            'action' => 'index'
                        )
                    );
                }
                $mensagem = $auth->authenticate()->getMessages();
                $this->flashMessenger()->AddErrorMessage($mensagem[0]);
            }
        }
        return new ViewModel(array('form' => $form));
    }

    /**
     * Logout
     */
    public function logoutAction() {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $auth->clearIdentity();
        $this->flashMessenger()->AddSuccessMessage("Logout realizado.");
        return $this->redirect()->toRoute(
            'login',
            array(
                'controller' => 'login',
                'action' => 'index'
            )
        );
    }
}
