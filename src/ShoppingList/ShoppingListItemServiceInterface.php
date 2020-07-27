<?php
namespace App\ShoppingList;


use App\ShoppingList\ORM\Entity\ShoppingListItem;

interface ShoppingListItemServiceInterface
{

    public function add(ShoppingListItem $shoppingListItem): int;
}