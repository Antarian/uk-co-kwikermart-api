<?php
namespace App\ShoppingList\Services;

use App\ShoppingList\Entities\ShoppingList;
use App\ShoppingList\Repositories\ShoppingListRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class ShoppingListService implements ShoppingListServiceInterface
{
    /**
     * @var ShoppingListRepositoryInterface
     */
    private $shoppingListRepository;

    /**
     * ShoppingListService constructor.
     * @param ShoppingListRepositoryInterface $shoppingListRepository
     */
    public function __construct(ShoppingListRepositoryInterface $shoppingListRepository)
    {
        $this->shoppingListRepository = $shoppingListRepository;
    }

    /**
     * @inheritDoc
     */
    public function addShoppingList(string $title): void
    {
        $shoppingList = ShoppingList::create($title);
        $this->shoppingListRepository->addShoppingList($shoppingList);
    }

    /**
     * @inheritDoc
     */
    public function findAllShoppingLists(): array
    {
        // TODO: Implement findAllShoppingLists() method.
    }

    /**
     * @inheritDoc
     */
    public function findShoppingList(UuidInterface $id): ShoppingList
    {
        // TODO: Implement findShoppingList() method.
    }
}
