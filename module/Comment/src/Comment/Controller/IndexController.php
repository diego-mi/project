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
        $post = $this->getRequest()->getPost()->toArray();
        $htmlOutput = $this->getHtmlComments($post['postid']);

        return new JsonModel(array('status' => $htmlOutput['html'], 'count' => $htmlOutput['count']));
    }


    /**
     * Funcao responsavel por adicionar um novo comentario e retornar todos os comentarios
     * daquele post em html
     *
     * @return JsonModel
     */
    public function addCommentAction()
    {
        $data = array();
        $post = $this->getRequest()->getPost()->toArray();
        $data['postId'] = $post['postid'];
        $data['content'] = $post['content'];
        $data['actionAuthorId'] = $this->identity()->getId();
        $service = $this->getServiceLocator()->get($this->service);
        $service->comment($data);

        $htmlOutput = $this->getHtmlComments($post['postid']);

        return new JsonModel(array('status' => $htmlOutput));
    }

    /**
     * Funcao responsavel por criar o html de comentarios
     *
     * @param array $arrComments Entities de comentarios
     * @return mixed
     */
    private function getHtmlComments($intPostid)
    {
        $comments = $this->getEm()
            ->getRepository('Comment\Entity\VwComment')
            ->findBy(array('commentPostId' => $intPostid));
        $htmlViewPart = new ViewModel();
        $htmlViewPart->setTerminal(true)
            ->setTemplate('comment/index/index')
            ->setVariables(array('comments' => $comments));

        $commentsHtml = $this->getServiceLocator()
            ->get('viewrenderer')
            ->render($htmlViewPart);

        return array('html' => $commentsHtml, 'count' => count($comments));
    }
}
