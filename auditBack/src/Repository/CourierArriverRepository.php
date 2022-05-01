<?php

namespace App\Repository;

use App\Entity\CourierArriver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CourierArriver>
 *
 * @method CourierArriver|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourierArriver|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourierArriver[]    findAll()
 * @method CourierArriver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourierArriverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CourierArriver::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CourierArriver $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CourierArriver $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CourierArriver[] Returns an array of CourierArriver objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CourierArriver
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
