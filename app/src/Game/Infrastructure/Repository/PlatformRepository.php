<?php

declare(strict_types=1);

namespace App\Game\Infrastructure\Repository;

use App\Game\Domain\Entity\Platform;
use App\Game\Domain\Repository\PlatformStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Platform>
 *
 * @method null|Platform find($id, $lockMode = null, $lockVersion = null)
 * @method null|Platform findOneBy(array $criteria, array $orderBy = null)
 * @method Platform[]    findAll()
 * @method Platform[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatformRepository extends ServiceEntityRepository implements PlatformStore
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Platform::class);
    }

    public function findOneByExternalId(string $externalId): ?Platform
    {
        return $this->findOneBy(['externalId' => $externalId]);
    }
}
