<?php

namespace App\ShoppingList\ORM\Repository;

use App\ShoppingList\ORM\Entity\ShoppingListItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShoppingListItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShoppingListItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShoppingListItem[]    findAll()
 * @method ShoppingListItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShoppingListItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShoppingListItem::class);
    }

    /**
     * @param ShoppingListItem $shoppingListItem
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(ShoppingListItem $shoppingListItem): int
    {
        $this->getEntityManager()->persist($shoppingListItem);
        $this->getEntityManager()->flush();

        return $shoppingListItem->getId();
    }

    // /**
    //  * @return ShoppingListItem[] Returns an array of ShoppingListItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShoppingListItem
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}