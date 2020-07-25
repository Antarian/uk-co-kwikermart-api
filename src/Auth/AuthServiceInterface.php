<?php
namespace App\Auth;

use App\Auth\ORM\Entity\User;

interface AuthServiceInterface
{
    /**
     * @param User $user
     */
    public function register(User $user);
}
