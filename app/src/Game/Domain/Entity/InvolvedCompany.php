<?php

declare(strict_types=1);

namespace App\Game\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class InvolvedCompany
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $externalId;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'boolean')]
    private bool $developer;

    #[ORM\Column(type: 'boolean')]
    private bool $publisher;

    /**
     * @var Collection<int, Game>
     */
    #[ORM\ManyToMany(targetEntity: Game::class, mappedBy: 'involvedCompanies')]
    private Collection $games;

    public function __construct(Uuid $id, string $externalId, string $name, bool $developer, bool $publisher)
    {
        $this->id = $id;
        $this->externalId = $externalId;
        $this->name = $name;
        $this->developer = $developer;
        $this->publisher = $publisher;
        $this->games = new ArrayCollection();
    }
}
