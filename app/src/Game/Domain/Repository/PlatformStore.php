<?php

declare(strict_types=1);

namespace App\Game\Domain\Repository;

use App\Game\Domain\Entity\Platform;

interface PlatformStore
{
    public function findOneByExternalId(string $externalId): ?Platform;
}
