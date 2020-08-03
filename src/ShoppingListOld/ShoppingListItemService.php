<?php
namespace App\ShoppingListOld;


use App\ShoppingListOld\ORM\Entity\ShoppingListItem;
use App\ShoppingListOld\ORM\Repository\ShoppingListItemRepository;

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