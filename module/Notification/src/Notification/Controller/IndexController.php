<?php
namespace Notification\Controller;

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
        $this->controller = 'Notification';
        $this->route = 'notification/default';
        $this->service = 'Notification\Service\NotificationService';
        $this->entity = 'Notification\Entity\Notification';
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $htmlOutput = $this->getHtmlComments();

        return new JsonModel(array('status' => $htmlOutput));
    }

    /**
     * Funcao responsavel por criar o html de comentarios
     *
     * @param array $arrComments Entities de comentarios
     * @return mixed
     */
    private function getHtmlComments()
    {
        $notifications = $this->getEm()
            ->getRepository('Notification\Entity\VwNotification')
            ->findBy(
                array(
                    'notificationPostAuthorId' => $this->identity()->getId(),
                ),
                array(
                    'notificationDate' => "DESC"
                ),
                4
            );
        $htmlViewPart = new ViewModel();
        $htmlViewPart->setTerminal(true)
            ->setTemplate('notification/index/index')
            ->setVariables(array('notifications' => $notifications));

        return $this->getServiceLocator()
            ->get('viewrenderer')
            ->render($htmlViewPart);
    }
}
