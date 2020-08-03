<?php
namespace App\ShoppingListOld;

use App\ShoppingListOld\ORM\Entity\ShoppingList;

interface ShoppingListServiceInterface
{
    /**
     * @param ShoppingList $shoppingList
     * @return int
     */
    public function add(ShoppingList $shoppingList): int;

    /**
     * @param string $getIdentity
     * @return array
     */
    public function finAllByCreatedBy(string $getIdentity): array;

    /**
     * @param int $id
     * @return ShoppingList
     */
    public function find(int $id): ShoppingList;
}
