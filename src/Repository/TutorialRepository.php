<?php

namespace App\Repository;

use App\Entity\Tutorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Tutorial>
 *
 * @method Tutorial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tutorial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tutorial[]    findAll()
 * @method Tutorial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TutorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,)
    {
        parent::__construct($registry, Tutorial::class);
    }

    public function save(Tutorial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tutorial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Tutorial[] Returns an array of Tutorial objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Tutorial
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function searchTutorials(string $userInput, ?array $filters): array
    {
        $qb = $this->createQueryBuilder('tutorial')
            ->where("tutorial.title LIKE :userInput")
            ->setParameter("userInput", "%" . $userInput . "%")
            ->leftJoin("tutorial.theme", "theme");


        if (isset($filters)) {
            foreach ($filters as $filterType => $filterKey) {
                $qb = $this->addFilter($qb, $filterType, $filterKey);
            }
        }

        return $qb->getQuery()->getResult();
    }

    public function addFilter(QueryBuilder $qb, string $filterType, string $filterKey): QueryBuilder
    {
        if ($filterType == "category") {
            $qb
                ->innerJoin("theme.category", "category", 'WITH', "category.id = theme.category")
                ->andWhere("category.id = " . $filterKey);
        };

        if ($filterType == "theme") {
            $qb->andWhere("theme.id = " . $filterKey);
        };

        if ($filterType == "tag") {
            $qb
                ->leftJoin("tutorial.tags", "tags")
                ->andWhere("tags.id = " . $filterKey);
        };

        return $qb;
    }
}
