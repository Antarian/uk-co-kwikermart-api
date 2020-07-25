<?php
namespace App\Auth\EventListener;

use App\Auth\ORM\Entity\User;
use App\Auth\ORM\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $payload = $event->getData();

        $user = $this->userRepository->findOneByEmail($payload['username']);
        if (!$user instanceof User) {
            return;
        }

        $payload['identity'] = $user->getIdentity();
        $event->setData($payload);
    }
}