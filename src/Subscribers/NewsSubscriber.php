<?php


namespace App\Subscribers;


use App\Entity\News;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class NewsSubscriber implements EventSubscriberInterface
{

    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => [['setUser'],['setCreatedAt'],['setStatus']]
        ];
    }

    public function setUser(BeforeEntityPersistedEvent  $event)
    {
        //dd($event);
        $entity = $event->getEntityInstance();
        if ($entity instanceof News) {
            $entity->setUser($this->security->getUser());
        }
    }
    public function setCreatedAt(BeforeEntityPersistedEvent  $event)
    {
        //dd($event);
        $entity = $event->getEntityInstance();
        if ($entity instanceof News) {
            $date= new \DateTime('@'.strtotime('now'));
            $entity->setCreatedAt($date);
        }
    }
    public function setStatus(BeforeEntityPersistedEvent  $event)
    {
        //dd($event);
        $entity = $event->getEntityInstance();
        if ($entity instanceof News) {
            $entity->setStatus("PUBLISHED");
        }
    }
}