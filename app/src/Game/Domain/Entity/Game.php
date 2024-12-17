<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity;

use App\Game\Domain\Enum\GameCategory;
use App\Game\Domain\Enum\GameStatus;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class Game
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $externalId;

    #[ORM\Column(type: 'string')]
    private string $name;

    /**
     * @var null|Collection<int, GameAgeRating>
     */
    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GameAgeRating::class, cascade: ['persist', 'remove'])]
    private ?Collection $gameAgeRatings;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $aggregatedRating = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $aggregatedRatingCount = null;

    #[ORM\Column(type: 'integer', nullable: true, enumType: GameCategory::class)]
    private ?GameCategory $category = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $cover = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeImmutable $firstReleaseDate = null;

    /**
     * @var null|string[]
     */
    #[ORM\Column(type: 'simple_array', nullable: true)]
    private ?array $franchise = null;

    /**
     * @var null|string[]
     */
    #[ORM\Column(type: 'simple_array', nullable: true)]
    private ?array $gameModes = null;

    /**
     * @var null|string[]
     */
    #[ORM\Column(type: 'simple_array', nullable: true)]
    private ?array $genres = null;

    /**
     * @var null|Collection<int, InvolvedCompany>
     */
    #[ORM\ManyToMany(targetEntity: InvolvedCompany::class, cascade: ['persist', 'remove'])]
    private ?Collection $involvedCompanies = null;

    /**
     * @var null|Collection<int, GamePlatform>
     */
    #[ORM\OneToMany(mappedBy: 'game', targetEntity: GamePlatform::class, cascade: ['persist', 'remove'])]
    private ?Collection $gamePlatforms;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $slug = null;

    #[ORM\Column(type: 'integer', nullable: true, enumType: GameStatus::class)]
    private ?GameStatus $status = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $storyline = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $summary = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $versionTitle = null;

    /**
     * @param null|string[]                         $franchise
     * @param null|string[]                         $gameModes
     * @param null|string[]                         $genres
     * @param null|Collection<int, GameAgeRating>   $gameAgeRatings
     * @param null|Collection<int, GamePlatform>    $gamePlatforms
     * @param null|Collection<int, InvolvedCompany> $involvedCompanies
     */
    public function __construct(
        Uuid $id,
        string $externalId,
        string $name,
        ?Collection $gameAgeRatings,
        ?float $aggregatedRating,
        ?int $aggregatedRatingCount,
        ?GameCategory $category,
        ?string $cover,
        ?array $franchise,
        ?array $gameModes,
        ?array $genres,
        ?Collection $involvedCompanies,
        ?Collection $gamePlatforms,
        ?\DateTimeImmutable $releaseDate,
        ?string $slug,
        ?GameStatus $status,
        ?string $storyline,
        ?string $summary,
        ?string $versionTitle,
    ) {
        $this->id = $id;
        $this->externalId = $externalId;
        $this->name = $name;
        $this->gameAgeRatings = $gameAgeRatings;
        $this->aggregatedRating = $aggregatedRating;
        $this->aggregatedRatingCount = $aggregatedRatingCount;
        $this->category = $category;
        $this->cover = $cover;
        $this->franchise = $franchise;
        $this->gameModes = $gameModes;
        $this->genres = $genres;
        $this->involvedCompanies = $involvedCompanies;
        $this->gamePlatforms = $gamePlatforms;
        $this->firstReleaseDate = $releaseDate;
        $this->slug = $slug;
        $this->status = $status;
        $this->storyline = $storyline;
        $this->summary = $summary;
        $this->versionTitle = $versionTitle;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): void
    {
        $this->id = $id;
    }

    /**
     * @param null|Collection<int, GameAgeRating> $gameAgeRatings
     */
    public function setGameAgeRatings(?Collection $gameAgeRatings): void
    {
        $this->gameAgeRatings = $gameAgeRatings;
    }

    /**
     * @param null|Collection<int, GamePlatform> $gamePlatforms
     */
    public function setGamePlatforms(?Collection $gamePlatforms): void
    {
        $this->gamePlatforms = $gamePlatforms;
    }

    /**
     * @param null|Collection<int, InvolvedCompany> $involvedCompanies
     */
    public function setInvolvedCompanies(?Collection $involvedCompanies): void
    {
        $this->involvedCompanies = $involvedCompanies;
    }
}
