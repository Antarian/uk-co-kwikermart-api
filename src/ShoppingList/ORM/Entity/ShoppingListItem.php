<?php

namespace App\ShoppingList\ORM\Entity;

use App\ShoppingList\ORM\Repository\ShoppingListItemRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ShoppingListItemRepository::class)
 */
class ShoppingListItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     *
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\Type("integer")
     */
    private $amount = 1;

    /**
     * @ORM\ManyToOne(targetEntity=ShoppingList::class, inversedBy="shoppingListItems")
     * @ORM\JoinColumn(nullable=false)
     *
     * @var ShoppingList
     *
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    private $shoppingList;

    /**
     * @ORM\Column(type="datetime_immutable")
     *
     * @var DateTimeImmutable
     *
     * @Assert\DateTime()
     */
    private $deletedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getShoppingList(): ShoppingList
    {
        return $this->shoppingList;
    }

    public function setShoppingList(ShoppingList $shoppingList): void
    {
        $this->shoppingList = $shoppingList;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDeletedAt(): DateTimeImmutable
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTimeImmutable $deletedAt
     */
    public function setDeletedAt(DateTimeImmutable $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
