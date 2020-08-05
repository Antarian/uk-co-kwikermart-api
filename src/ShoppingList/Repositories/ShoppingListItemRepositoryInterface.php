<?php
namespace App\ShoppingList\Repositories;

use App\ShoppingList\Entities\ShoppingListItem;
use Ramsey\Uuid\UuidInterface;

interface ShoppingListItemRepositoryInterface
{
    /**
     * @param UuidInterface $id
     * @return ShoppingListItem|null
     */
    //public function find(UuidInterface $id): ?ShoppingListItem;

    /**
     * @param ShoppingListItem $shoppingListItem
     */
    public function add(ShoppingListItem $shoppingListItem): void;
}
