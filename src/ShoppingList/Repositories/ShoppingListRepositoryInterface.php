
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
    public function findShoppingList(UuidInterface $id): ?ShoppingList;

    /**
     * @param ShoppingList $shoppingList
     */
    public function addShoppingList(ShoppingList $shoppingList): void;

    /**
     * @param ShoppingList $shoppingList
     */
    public function updateShoppingList(ShoppingList $shoppingList): void;
}
