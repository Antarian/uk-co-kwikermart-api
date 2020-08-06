<?php
namespace App\ShoppingList\Entities;

use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class ShoppingList
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var ShoppingListItem[]
     */
    private $items = [];

    /**
     * ShoppingList constructor.
     * @param UuidInterface $shoppingListId
     * @param string $title
     */
    private function __construct(
        UuidInterface $id,
        string $title
    ) {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * @param UuidInterface $id
     * @param string $title
     *
     * @return ShoppingList
     */
    public static function create(
        string $title
    ): ShoppingList
    {
        $id = Uuid::uuid6();
        return new self($id, $title);
    }

    /**
     * @param UuidInterface $id
     * @param string $title
     *
     * @return ShoppingList
     */
    public static function populate(
        UuidInterface $id,
        string $title
    ): ShoppingList
    {
        return new self($id, $title);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return ShoppingListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param string $title
     */
    public function addItem(string $title): void
    {
        $sortNumber = \count($this->items) + 1;

        // we also pass $this (the PurchaseOrder) to the Line:
        $this->items[] = new ShoppingListItem($this, $sortNumber, $title);
    }

    /**
     * @param ShoppingListItem $item
     */
    public function removeItem(ShoppingListItem $item): void
    {
        $key = array_search($item->getTitle(), array_column($this->items, 'title'));
        unset($this->items[$key]);
    }

    /**
     * @param string $newTitle
     */
    public function changeTitle(string $newTitle): void
    {
        $this->title = $newTitle;
    }
}
