<?php
namespace Post\Controller;

use Base\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{

    /**
     * __construct
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
        $service = $this->getServiceLocator()->get($this->service);
        $data = $service->getPosts($this->identity()->getId());
        $this->form = $this->getServiceLocator()->get($this->form);

        return new ViewModel(array('list' => $data['posts'], 'form' => $this->form, 'gostei' => $data['gostei']));
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

                    return $this->redirect()
                        ->toRoute($this->route, array('controller' => $this->controller, 'action' => 'index'));
                } else {
                    $this->flashMessenger()->addErrorMessage('Não foi possivel cadastrar! Tente mais tarde.');
                }
            } else {
                $this->flashMessenger()->addErrorMessage('Form inválido.');
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
    public function viewAction()
    {
        $intPostId = $this->params()->fromRoute('id');
        $post = $this->getEm()->getRepository($this->entity)->find($intPostId);
        return new ViewModel(array('post' => $post));
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
