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
        $booIsFollowing = false;
        if ( empty($intProfileId)) {
            $intProfileId = $this->identity()->getId();
        } else {
            $arrVerifyFollowing =  $this->getEm()->getRepository('Friend\Entity\Following')->findBy(
                array(
                    'followerId' => $this->identity()->getId(),
                    'followingId' => $intProfileId
                ),
                array(
                    'followingName' => 'ASC'
                ),
                1
            );
            if (count($arrVerifyFollowing)) {
                $booIsFollowing = true;
            }
        }

        $arrFollowing =  $this->getEm()->getRepository('Friend\Entity\Following')->findBy(
            array(
                'followerId' => $intProfileId
            ),
            array(
                'followingName' => 'ASC'
            ),
            10
        );

        $servicePost = $this->getServiceLocator()->get('Post\Service\PostService');
        $data = $servicePost->getPostsProfile($intProfileId);

        $profile = $this->getEm()->getRepository($this->entity)->find($intProfileId);
        return new ViewModel(array(
            'profile' => $profile,
            'list' => $data['posts'],
            'gostei' => $data['gostei'],
            'friends' => $arrFollowing,
            'isFollowing' => $booIsFollowing
        ));
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
                $data = $form->getData();

                if (empty($data['picture']['tmp_name'])) {
                    unset($data['picture']);
                }

                $data['id'] = $this->identity()->getId();
                if ($service->save($data, $this->identity()->getId())) {
                    $this->flashMessenger()->addSuccessMessage('Editado com sucesso!');
                    return $this->redirect()
                        ->toRoute('profile-editar');
                } else {
                    $this->flashMessenger()->addErrorMessage('Não foi possivel editar! Tente mais tarde.');
                }
            } else {
                $this->flashMessenger()->addErrorMessage('Form inválido.');
            }
        }


        $profile = $this->getEm()->getRepository($this->entity)->find($intProfileId)->toArray();
        $form = $this->getServiceLocator()->get($this->form);
        $form->populateValues($profile);

        if ($this->flashMessenger()->hasSuccessMessages()) {
            return new ViewModel(array(
                'profile' => $profile,
                'form' => $form,
                'success' => $this->flashMessenger()->getSuccessMessages()
            ));
        }

        if ($this->flashMessenger()->hasErrorMessages()) {
            return new ViewModel(array(
                'profile' => $profile,
                'form' => $form,
                'error' => $this->flashMessenger()->getErrorMessages()
            ));
        }

        return new ViewModel(array('profile' => $profile, 'form' => $form));
    }
}
