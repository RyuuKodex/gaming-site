<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Repository;

use App\Game\Domain\Entity\AgeRating;
use App\Game\Domain\Repository\AgeRatingStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgeRating>
 *
 * @method null|AgeRating find($id, $lockMode = null, $lockVersion = null)
 * @method null|AgeRating findOneBy(array $criteria, array $orderBy = null)
 * @method AgeRating[]    findAll()
 * @method AgeRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgeRatingRepository extends ServiceEntityRepository implements AgeRatingStore
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgeRating::class);
    }

    public function findOneByRating(int $rating): ?AgeRating
    {
        return $this->findOneBy(['rating' => $rating]);
    }
}
