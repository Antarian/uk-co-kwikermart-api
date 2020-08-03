<?php
namespace App\ShoppingList\ValueObjects;


class ShoppingListId
{
    /** @var string */
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function create()
    {
        return new self(new Uuid());
    }

    public function asString(): string
    {
        return $this->id;
    }
}