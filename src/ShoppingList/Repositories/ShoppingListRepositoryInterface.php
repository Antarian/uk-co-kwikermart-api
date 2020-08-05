<?php
namespace App\ShoppingList\Repositories;

use App\ShoppingList\Entities\ShoppingList;
use Ramsey\Uuid\UuidInterface;

interface ShoppingListRepositoryInterface
{
    /**
     * @param UuidInterface $id
     * @return ShoppingList|null
     */
    //public function find(UuidInterface $id): ?ShoppingList;

    /**
     * @param ShoppingList $shoppingList
     */
    public function add(ShoppingList $shoppingList): void;
}
