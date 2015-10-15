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

        return new JsonModel(array('html' => $htmlOutput['html'], 'count' => $htmlOutput['count']));
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
            ->getNewNotifications($this->identity()->getId());
        $htmlViewPart = new ViewModel();
        $htmlViewPart->setTerminal(true)
            ->setTemplate('notification/index/index')
            ->setVariables(array('notifications' => $notifications));

        $notificationsHtml = $this->getServiceLocator()
            ->get('viewrenderer')
            ->render($htmlViewPart);

        return array('html' => $notificationsHtml, 'count' => count($notifications));
    }

    /**
     * Metodo responsavel por mudar status da notificacao para visualizada
     *
     * @return JsonModel
     */
    public function setNotificationToOldAction()
    {
        $post = $this->getRequest()->getPost()->toArray();
        $intNotificationId = $post['notificationId'];
        $service = $this->getServiceLocator()->get($this->service);
        $returnAction = $service->setNotificationToOld($intNotificationId);
        return new JsonModel(array('html' => $returnAction));
    }

    /**
     * Metodo responsavel por carregar a view de visualizar notificacoes
     */
    public function notificationsAction() {
        $notifications = $this->getEm()
            ->getRepository('Notification\Entity\VwNotification')
            ->getAllNotifications($this->identity()->getId());
        return new ViewModel(array('notifications' => $notifications));
    }
}
