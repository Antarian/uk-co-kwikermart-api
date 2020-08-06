<?php
namespace App\ShoppingList\Factories;

use App\Auth\Event\RegisteredEvent;
use App\ShoppingList\Entities\ShoppingList;
use App\ShoppingList\Repositories\ShoppingListRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ShoppingListRegistrationFactory implements EventSubscriberInterface
{
    /**
     * @var ShoppingListRepositoryInterface
     */
    private $shoppingListRepository;

    /**
     * ShoppingListRegistrationFactory constructor.
     * @param ShoppingListRepositoryInterface $shoppingListRepository
     */
    public function __construct(ShoppingListRepositoryInterface $shoppingListRepository)
    {
        $this->shoppingListRepository = $shoppingListRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            RegisteredEvent::REGISTER => [
                ['createShoppingList', 0]
            ],
        ];
    }

    public function createShoppingList(RegisteredEvent $event)
    {
        $shoppingList = ShoppingList::create(Uuid::uuid6(), 'Quick shopping list');
        $this->shoppingListRepository->add($shoppingList);
    }
}
