<?php
namespace App\Auth\Event;

use Symfony\Contracts\EventDispatcher\Event;

class RegisteredEvent extends Event
{
    const REGISTER = 'auth.register';

    private $userId;

    /**
     * RegisteredEvent constructor.
     * @param int $userId
     */
    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}
