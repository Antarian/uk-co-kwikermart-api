<?php
namespace App\ShoppingList\Services;

use App\ShoppingList\Entities\ShoppingList;
use Ramsey\Uuid\UuidInterface;

interface ShoppingListServiceInterface
{
    /**
     * @param string $title
     */
    public function addShoppingList(string $title): void;

    /**
     * @return ShoppingList[]|array
     */
    public function findAllShoppingLists(): array;

    /**
     * @param UuidInterface $id
     * @return ShoppingList
     */
    public function findShoppingList(UuidInterface $id): ShoppingList;
}
