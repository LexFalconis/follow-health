<?php

namespace App\Repository;

use App\Entity\SatisfactionWithFood;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SatisfactionWithFood>
 *
 * @method SatisfactionWithFood|null find($id, $lockMode = null, $lockVersion = null)
 * @method SatisfactionWithFood|null findOneBy(array $criteria, array $orderBy = null)
 * @method SatisfactionWithFood[]    findAll()
 * @method SatisfactionWithFood[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SatisfactionWithFoodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SatisfactionWithFood::class);
    }

    public function save(SatisfactionWithFood $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(SatisfactionWithFood $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return SatisfactionWithFood[] Returns an array of SatisfactionWithFood objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SatisfactionWithFood
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
