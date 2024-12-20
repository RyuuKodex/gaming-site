<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class GamePlatform
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'gamePlatforms')]
    #[ORM\JoinColumn(nullable: false)]
    private Game $game;

    #[ORM\ManyToOne(targetEntity: Platform::class, cascade: ['persist'], inversedBy: 'gamePlatforms')]
    #[ORM\JoinColumn(nullable: false)]
    private Platform $platform;

    public function __construct(Uuid $id, Platform $platform, Game $game)
    {
        $this->id = $id;
        $this->platform = $platform;
        $this->game = $game;
    }
}
