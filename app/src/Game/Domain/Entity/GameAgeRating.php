<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class GameAgeRating
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'gameAgeRatings')]
    #[ORM\JoinColumn(nullable: false)]
    private Game $game;

    #[ORM\ManyToOne(targetEntity: AgeRating::class, cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private AgeRating $ageRating;

    public function __construct(Uuid $id, AgeRating $ageRating, Game $game)
    {
        $this->id = $id;
        $this->ageRating = $ageRating;
        $this->game = $game;
    }
}
