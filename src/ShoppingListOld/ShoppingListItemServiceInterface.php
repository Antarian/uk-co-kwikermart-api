<?php
namespace App\ShoppingListOld;


use App\ShoppingListOld\ORM\Entity\ShoppingListItem;

interface ShoppingListItemServiceInterface
{

    public function add(ShoppingListItem $shoppingListItem): int;
}