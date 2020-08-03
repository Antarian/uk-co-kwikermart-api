<?php
namespace App\ShoppingList\Repositories;

use App\ShoppingList\Entities\ShoppingList;

interface ShoppingListRepositoryInterface
{
    /**
     * @param int $id
     * @return ShoppingList
     */
    public function findShoppingList(int $id): ShoppingList;

    /**
     * @param ShoppingList $shoppingList
     */
    public function addShoppingList(ShoppingList $shoppingList): void;
}