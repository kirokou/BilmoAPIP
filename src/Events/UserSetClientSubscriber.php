<?php

namespace App\Events;

use App\Entity\User;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class UserSetClientSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            // Kernel view intervient après la désérialisation. je me place ensuite avant la validation
            kernelEvents::VIEW => ['setUserForClient', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function setUserForClient(ViewEvent $event)
    {
        //getControllerResult retourne l'element sur lequel l'event est entrain de se produire
        $user = $event->getControllerResult();
        //getRequest()->getMethod() retourne la methode qui est entrain d'être utilisée. 
        $method = $event->getRequest()->getMethod();
        // Chopper Le client connecté actuellement et qui est entrain de créer un User. 
        $currentClient = $this->security->getUser();
      
        if ($user instanceof User && $method == "POST") {
            $user->setClient($currentClient);
        }
    }
}

