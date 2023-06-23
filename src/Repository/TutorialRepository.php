<?php

namespace App\Repository;

use App\Entity\Theme;
use App\Entity\Tutorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    public function searchTutorials(string $searchData): array
    {
        return $this->createQueryBuilder('tutorial')
            ->where("tutorial.title LIKE '%" . $searchData . "%'")
            ->getQuery()
            ->getResult();
    }

    public function filterByCategory(string $searchData, int $categoryID): array
    {
        $qb = $this->createQueryBuilder("tutorial")
            ->leftJoin("tutorial.theme", "theme")
            ->innerJoin("theme.category", "category", 'WITH', "category.id = theme.category")
            ->andWhere("tutorial.title LIKE :searchData")
            ->setParameter("searchData", "%" . $searchData . "%")
            ->andWhere("theme.id = " . $categoryID);

        return $qb->getQuery()->execute();
    }

    public function filterByTheme(string $searchData, int $themeID): array
    {
        $qb = $this->createQueryBuilder("tutorial")
            ->leftJoin("tutorial.theme", "theme")
            ->andWhere("tutorial.title LIKE :searchData")
            ->setParameter("searchData", "%" . $searchData . "%")
            ->andWhere("theme.id = " . $themeID);

        return $qb->getQuery()->execute();
    }


    public function filterByTag(string $searchData, int $tagsID): array
    {
        $qb = $this->createQueryBuilder("tutorial")
            ->leftJoin("tutorial.tags", "tags")
            ->andWhere("tutorial.title LIKE '%" . $searchData . "%'")
            ->andWhere("tags.id = " . $tagsID);

        return $qb->getQuery()->execute();
    }



    // WIP
    // public function filterBy(string $searchData, ?int $categoryID, ?int $themeID, ?array $tagIDs)
    // {
    //     $qb = $this->createQueryBuilder("tutorial")
    //         ->where("tutorial.title LIKE '%vol%'");

    //     if ($categoryID) {
    //         $qb
    //             ->innerJoin(Category::class, "category", 'WITH', "category = tutorial.theme.category")
    //             ->andWhere("category.id = " . $categoryID);
    //     }

    //     if ($themeID) {
    //         $qb
    //             ->innerJoin("tutorial.theme", "theme", 'WITH', "theme = tutorial.theme")
    //             ->andWhere("theme.id = " . $themeID);
    //     }

    //     if ($tagIDs) {
    //         $qb->innerJoin("tutorial.tags", "tags", 'WITH', "tags.id = tutorial.tags");

    //         foreach ($tagIDs as $tagID) {
    //             $qb->andWhere("tags.id = " . $tagID);
    //         }
    //     }

    //     // dd($qb->getQuery());
    //     dd($qb->getQuery()->execute());

    //     // return $qb->getQuery()->execute();
    // }
}
