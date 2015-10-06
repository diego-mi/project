<?php
namespace Notification\Service;

use Base\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class NotificationService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = 'Notification\Entity\Notification';
        parent::__construct($em);
    }

    public function setNotificationToOld($intNotificationId)
    {
        $entity = $this->em->getRepository('Notification\Entity\Notification')->find($intNotificationId);
        $entity->setStatus(1);
        $this->em->persist($entity);
        $this->em->flush();

        return true;
    }
}
