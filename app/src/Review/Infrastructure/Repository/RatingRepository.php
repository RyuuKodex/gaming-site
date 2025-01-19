<?php

declare(strict_types=1);

namespace App\Review\Infrastructure\Repository;

use App\Review\Domain\Entity\Rating;
use App\Review\Domain\Repository\RatingStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rating>
 *
 * @method null|Rating find($id, $lockMode = null, $lockVersion = null)
 * @method null|Rating findOneBy(array $criteria, array $orderBy = null)
 * @method Rating[]    findAll()
 * @method Rating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatingRepository extends ServiceEntityRepository implements RatingStore
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rating::class);
    }

    public function findOneById(string $id): ?Rating
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function save(Rating $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }
}
