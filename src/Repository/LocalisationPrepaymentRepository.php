<?php

namespace App\Repository;

use App\Entity\LocalisationPrepayment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LocalisationPrepayment>
 *
 * @method LocalisationPrepayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method LocalisationPrepayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method LocalisationPrepayment[]    findAll()
 * @method LocalisationPrepayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalisationPrepaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LocalisationPrepayment::class);
    }

    public function add(LocalisationPrepayment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LocalisationPrepayment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LocalisationPrepayment[] Returns an array of LocalisationPrepayment objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LocalisationPrepayment
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
