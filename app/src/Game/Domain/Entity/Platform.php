<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Platform
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $externalId;

    #[ORM\Column(type: 'string')]
    private string $name;

    /**
     * @var Collection<int, GamePlatform>
     */
    #[ORM\OneToMany(mappedBy: 'platform', targetEntity: GamePlatform::class, cascade: ['persist', 'remove'])]
    private Collection $gamePlatforms;

    public function __construct(Uuid $id, string $externalId, string $name)
    {
        $this->id = $id;
        $this->externalId = $externalId;
        $this->name = $name;
        $this->gamePlatforms = new ArrayCollection();
    }
}
