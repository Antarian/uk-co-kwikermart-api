<?php
namespace App\ShoppingList\Repositories;

use App\ShoppingList\Entities\ShoppingList;
use Ramsey\Uuid\UuidInterface;

class ShoppingListRepository implements ShoppingListRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findShoppingList(UuidInterface $id): ?ShoppingList
    {
        // TODO: Implement findShoppingList() method.
    }

    /**
     * @inheritDoc
     */
    public function addShoppingList(ShoppingList $shoppingList): void
    {
        // TODO: Implement addShoppingList() method.
    }

    /**
     * @inheritDoc
     */
    public function updateShoppingList(ShoppingList $shoppingList): void
    {
        // TODO: Implement updateShoppingList() method.
    }
}
