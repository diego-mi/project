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
}
