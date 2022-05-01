<?php

namespace App\Repository;

use App\Entity\FicheDeControle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FicheDeControle>
 *
 * @method FicheDeControle|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheDeControle|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheDeControle[]    findAll()
 * @method FicheDeControle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheDeControleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheDeControle::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(FicheDeControle $entity, bool $flush = true): void
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
    public function remove(FicheDeControle $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return FicheDeControle[] Returns an array of FicheDeControle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheDeControle
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
