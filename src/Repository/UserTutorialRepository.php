<?php

namespace App\Repository;

use App\Entity\Tutorial;
use App\Entity\User;
use App\Entity\UserTutorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserTutorial>
 *
 * @method UserTutorial|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTutorial|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTutorial[]    findAll()
 * @method UserTutorial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTutorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserTutorial::class);
    }

    public function save(UserTutorial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserTutorial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return UserTutorial[] Returns an array of UserTutorial objects
     */
/*    public function findByValidated($value): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }*/

    public function findByValidated(User $user): array
    {
        return $this->createQueryBuilder('qb')
            ->andWhere('qb.user = :user')
            ->setParameter('user', $user)
            ->andWhere('qb.isValidated = true')
            ->orderBy('qb.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllLiked(User $user): array
    {
        return $this->createQueryBuilder('qb')
            ->andWhere('qb.user = :user')
            ->setParameter('user', $user)
            ->having('qb.isLiked = true')
            ->orderBy('qb.updatedAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findOne(User $user, Tutorial $tutorial): ?UserTutorial
    {
        return $this->createQueryBuilder('qb')
            ->andWhere('qb.user = :user')
            ->setParameter('user', $user)
            ->andWhere('qb.tutorial = :tutorial')
            ->setParameter('tutorial', $tutorial)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
/*    public function findOneIsParameter(User $user, Tutorial $tutorial, string $parameter): ?UserTutorial
    {
        if ('isLiked' === $parameter) {
            return $this->createQueryBuilder('qb')
                ->andWhere('qb.user = :user')
                ->setParameter('user', $user)
                ->andWhere('qb.tutorial = :tutorial')
                ->setParameter('tutorial', $tutorial)
                ->andWhere('qb.isLiked = true')
                ->getQuery()
                ->getOneOrNullResult()
                ;
        } elseif ('isValidated' === $parameter) {
            return $this->createQueryBuilder('qb')
                ->andWhere('qb.user = :user')
                ->setParameter('user', $user)
                ->andWhere('qb.tutorial = :tutorial')
                ->setParameter('tutorial', $tutorial)
                ->andWhere('qb.isValidated = true')
                ->getQuery()
                ->getOneOrNullResult()
                ;
        }
    }*/

//    public function findOneBySomeField($value): ?UserTutorial
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
