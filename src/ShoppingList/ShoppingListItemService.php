<?php
namespace App\ShoppingList;


use App\ShoppingList\ORM\Entity\ShoppingListItem;
use App\ShoppingList\ORM\Repository\ShoppingListItemRepository;

class ShoppingListItemService implements ShoppingListItemServiceInterface
{
    /**
     * @var ShoppingListItemRepository
     */
    private $shoppingListItemRepository;

    /**
     * ShoppingListItemService constructor.
     * @param ShoppingListItemRepository $shoppingListItemRepository
     */
    public function __construct(ShoppingListItemRepository $shoppingListItemRepository)
    {
        $this->shoppingListItemRepository = $shoppingListItemRepository;
    }

    /**
     * @param ShoppingListItem $shoppingListItem
     */
    public function add(ShoppingListItem $shoppingListItem): int
    {
        return $this->shoppingListItemRepository->add($shoppingListItem);
    }
}