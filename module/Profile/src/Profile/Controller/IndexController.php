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
        $this->entity = 'Profile\Entity\Profile';
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $intProfileId =  $page = $this->params()->fromRoute('id');
        if ( empty($intProfileId)) {
            $intProfileId = $this->identity()->getId();
        }
        $profile = $this->getEm()->getRepository($this->entity)->find($intProfileId);
        $posts = $this->getEm()->getRepository('Post\Entity\VwPost')->findBy(array('userId' => $intProfileId));
        return new ViewModel(array('profile' => $profile, 'list' => $posts));
    }

    /**
     * @return ViewModel
     */
    public function editarAction()
    {
        $intProfileId =  $page = $this->params()->fromRoute('id');
        if ( empty($intProfileId)) {
            $intProfileId = $this->identity()->getId();
        }
        $form = $this->getServiceLocator()->get($this->form);
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
                if ($service->save($form->getData(), $this->identity()->getId())) {
                    $this->flashMessenger()->addSuccessMessage('Editado com sucesso!');
                    return $this->redirect()
                        ->toRoute('profile-editar');
                } else {
                    $this->flashMessenger()->addErrorMessage('Não foi possivel editar! Tente mais tarde.');
                }
                //return $this->redirect()
                //    ->toRoute($this->route, array('controller' => $this->controller, 'action' => 'inserir'));
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

        $profile = $this->getEm()->getRepository($this->entity)->find($intProfileId)->toArray();
        $form = $this->getServiceLocator()->get($this->form);
        $form->populateValues($profile);

        return new ViewModel(array('profile' => $profile, 'form' => $form));
    }
}
