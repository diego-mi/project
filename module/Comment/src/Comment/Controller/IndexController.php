<?php
namespace Comment\Controller;

use Base\Controller\AbstractController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{

    /**
     * __construct
     */
    function __construct()
    {
        $this->controller = 'Comment';
        $this->route = 'comment/default';
        $this->service = 'Comment\Service\CommentService';
        $this->entity = 'Comment\Entity\Comment';
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $data = array();
        $post = $this->getRequest()->getPost()->toArray();
        $data['postId'] = $post['postid'];
        $data['content'] = $post['content'];
        $data['userId'] = $this->identity()->getId();
        $service = $this->getServiceLocator()->get($this->service);


        $result = $service->comment($data);

        $htmlViewPart = new ViewModel();
        $htmlViewPart->setTerminal(true)
            ->setTemplate('comment/index/index')
            ->setVariables(array(
                'comments' => $result
            ));

        $htmlOutput = $this->getServiceLocator()
            ->get('viewrenderer')
            ->render($htmlViewPart);



        return new JsonModel(array('status' => $htmlOutput));
    }

}
