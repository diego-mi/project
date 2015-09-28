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
        $this->form = $this->getServiceLocator()->get($this->form);

        return new ViewModel(array('list' => $list, 'form' => $this->form));
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function inserirAction()
    {
        $this->form = $this->getServiceLocator()->get($this->form);
        $form = $this->form;
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData(
                array_merge_recursive(
                    $request->getPost()->toArray(),
                    $request->getFiles()->toArray()
                )
            );

            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                if ($service->insert($form->getData(), $this->identity()->getId())) {
                    $this->flashMessenger()->addSuccessMessage('Cadastrado com sucesso!');
                } else {
                    $this->flashMessenger()->addErrorMessage('Não foi possivel cadastrar! Tente mais tarde.');
                }
                //return $this->redirect()
                //    ->toRoute($this->route, array('controller' => $this->controller, 'action' => 'inserir'));
            }
        }

        if ($this->flashMessenger()->hasSuccessMessages()) {
            return new ViewModel(array(
                'form' => $form,
                'success' => $this->flashMessenger()->getSuccessMessages()
            ));
        }

        if ($this->flashMessenger()->hasErrorMessages()) {
            return new ViewModel(array(
                'form' => $form,
                'error' => $this->flashMessenger()->getErrorMessages()
            ));
        }

        $this->flashMessenger()->clearMessages();
        return new ViewModel(array('form' => $form));
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
