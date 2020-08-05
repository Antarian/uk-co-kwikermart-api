<?php
namespace App\ShoppingList\Services;

use App\ShoppingList\Entities\ShoppingList;
use Ramsey\Uuid\UuidInterface;

class ShoppingListService implements ShoppingListServiceInterface
{

    /**
     * @inheritDoc
     */
    public function addShoppingList(string $title): void
    {

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
