<?php
namespace App\ShoppingList\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
final class ShoppingListItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="ShoppingList")
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
}
