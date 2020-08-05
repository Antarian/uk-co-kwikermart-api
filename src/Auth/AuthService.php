<?php
namespace App\Auth;

use App\Auth\Event\RegisteredEvent;
use App\Auth\ORM\Entity\User;
use App\Auth\ORM\Repository\UserRepository;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class AuthService implements AuthServiceInterface
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * AuthService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository, EventDispatcherInterface $eventDispatcher)
    {
        $this->repository = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param User $user
     */
    public function register(User $user)
    {
        $user->setIdentity($this->randomTokenGenerator(48));
        $this->repository->register($user);

        $event = new RegisteredEvent($user->getId());
        $this->eventDispatcher->dispatch($event, RegisteredEvent::REGISTER);
    }

    private function randomTokenGenerator($length)
    {
        return bin2hex(random_bytes($length));
    }
}
