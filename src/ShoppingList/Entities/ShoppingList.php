<?php
namespace App\ShoppingList\Entities;

use App\ShoppingList\ValueObjects\ShoppingListId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
final class ShoppingList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     * @var string
     */
    private $id;

    /** @var string */
    private $title;

    /** @var ShoppingListItem[] */

    /**
     * @ORM\OneToMany(
     *   targetEntity="ShoppingListItem",
     *   mappedBy="shoppingList",
     *   cascade={"PERSIST"}
     * )
     * @var Collection|ShoppingListItem[]
     */
    private $items;

    /**
     * ShoppingList constructor.
     * @param ShoppingListId $shoppingListId
     * @param string $title
     */
    private function __construct(
        ShoppingListId $shoppingListId,
        string $title
    ) {
        $this->id = $shoppingListId->asString();
        $this->title = $title;

        $this->items = new ArrayCollection();
    }

    public static function create(
        ShoppingListId $shoppingListId,
        string $title
    ): ShoppingList
    {
        return new self($shoppingListId, $title);
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
        return $this->items->toArray();
    }

    /**
     * @param string $title
     */
    public function addItem(string $title): void
    {
        $sort = \count($this->items) + 1;

        // we also pass $this (the PurchaseOrder) to the Line:
        $this->items[] = new ShoppingListItem($this, $sort, $title);
    }

    /**
     * @param ShoppingListItem $item
     */
    public function removeItem(ShoppingListItem $item): void
    {
        $key = array_search($item->getId(), array_column($this->items, 'id'));
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
