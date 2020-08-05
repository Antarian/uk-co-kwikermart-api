<?php
namespace App\ShoppingList\Repositories;

use App\ShoppingList\Entities\ShoppingListItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShoppingListItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingListItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingListItem[]    findAll()
 * @method ShoppingListItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingListItemRepository extends ServiceEntityRepository implements ShoppingListItemRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingListItem::class);
    }

    public function add(ShoppingListItem $shoppingListItem): void
    {
        $this->getEntityManager()->persist($shoppingListItem);
        $this->getEntityManager()->flush();
    }
}
