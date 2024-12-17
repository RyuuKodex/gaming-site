<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity;

use App\Game\Domain\Enum\AgeRatingCategory;
use App\Game\Domain\Enum\Rating;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class AgeRating
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $externalId;

    #[ORM\Column(type: 'integer', enumType: Rating::class)]
    private Rating $rating;

    #[ORM\Column(type: 'integer', enumType: AgeRatingCategory::class)]
    private AgeRatingCategory $category;

    public function __construct(Uuid $id, string $externalId, Rating $rating, AgeRatingCategory $category)
    {
        $this->id = $id;
        $this->externalId = $externalId;
        $this->rating = $rating;
        $this->category = $category;
    }
}
