<?php
namespace App\ShoppingList\Entities;

final class ShoppingListItem
{
    /**
     * @var ShoppingList
     */
    private $shoppingList;

    /** @var int */
    private $sortNumber;

    /** @var string */
    private $title;

    /**
     * ShoppingListItem constructor.
     * @param ShoppingList $shoppingList
     * @param int $sortNumber
     * @param string $title
     */
    public function __construct(
        ShoppingList $shoppingList,
        int $sortNumber,
        string $title
    ) {
        $this->shoppingList = $shoppingList;
        $this->sortNumber = $sortNumber;
        $this->title = $title;
    }

    /**
     * @return ShoppingList
     */
    public function getShoppingList(): ShoppingList
    {
        return $this->shoppingList;
    }

    /**
     * @param ShoppingList $shoppingList
     */
    public function setShoppingList(ShoppingList $shoppingList): void
    {
        $this->shoppingList = $shoppingList;
    }

    /**
     * @return int
     */
    public function getSortNumber(): int
    {
        return $this->sortNumber;
    }

    /**
     * @param int $sortNumber
     */
    public function setSortNumber(int $sortNumber): void
    {
        $this->sortNumber = $sortNumber;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
