<?php
namespace App\ShoppingListOld;

use App\ShoppingListOld\ORM\Entity\ShoppingList;
use App\ShoppingListOld\ORM\Repository\ShoppingListRepository;

class ShoppingListService implements ShoppingListServiceInterface
{
    /**
     * @var ShoppingListRepository
     */
    private $repository;

    /**
     * ShoppingListService constructor.
     * @param ShoppingListRepository $repository
     */
    public function __construct(ShoppingListRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param ShoppingList $shoppingList
     * @return int
     */
    public function add(ShoppingList $shoppingList): int
    {
        return $this->repository->add($shoppingList);
    }

    /**
     * @param string $identity
     * @return array
     */
    public function finAllByCreatedBy(string $identity): array
    {
        return $this->repository->findBy(['createdBy' => $identity]);
    }

    /**
     * @param int $id
     * @return ShoppingList
     */
    public function find(int $id): ShoppingList
    {
        return $this->repository->find($id);
    }
}
