<?php
namespace App\Auth;

use App\Auth\ORM\Entity\User;
use App\Auth\ORM\Repository\UserRepository;

class AuthService implements AuthServiceInterface
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * AuthService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param User $user
     */
    public function register(User $user)
    {
        $user->setIdentity($this->randomTokenGenerator(48));
        $this->repository->register($user);
    }

    private function randomTokenGenerator($length)
    {
        return bin2hex(random_bytes($length));
    }
}
