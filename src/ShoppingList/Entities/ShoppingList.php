<?php
namespace App\ShoppingList\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity()
 */
final class ShoppingList
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     *
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @ORM\OneToMany(
     *   targetEntity="ShoppingListItem",
     *   mappedBy="shoppingList",
     *   cascade={"PERSIST"}
     * )
     *
     * @var Collection|ShoppingListItem[]
     */
    private $items;

    /**
     * ShoppingList constructor.
     * @param UuidInterface $shoppingListId
     * @param string $title
     */
    private function __construct(
        UuidInterface $shoppingListId,
        string $title
    ) {
        $this->id = $shoppingListId;
        $this->title = $title;

        $this->items = new ArrayCollection();
    }

    /**
     * @param UuidInterface $shoppingListId
     * @param string $title
     *
     * @return ShoppingList
     */
    public static function create(
        UuidInterface $shoppingListId,
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
