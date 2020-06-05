<?php

namespace App\Events;

use App\Entity\Client;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class PasswordEncoderSubscriber implements EventSubscriberInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            // Kernel view intervient après la désérialisation avant l'envoi de l'objet à la bdd
            kernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE]
        ];
    }

    public function encodePassword(ViewEvent $event)
    {
        //getControllerResult retourne l'element sur lequel l'event est entrain de se produire
        $result = $event->getControllerResult();
        //getRequest()->getMethod() retourne la methode qui est entrain d'être utilisée. 
        $method = $event->getRequest()->getMethod();

        if ($result instanceof Client && $method == "POST") {
            $hash = $this->encoder->encodePassword($result, $result->getPassword());
            $result->setPassword($hash)
                ->setRoles(['ROLE_USER']);
        }
    }
}
