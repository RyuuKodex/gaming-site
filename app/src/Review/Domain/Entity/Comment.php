<?php

declare(strict_types=1);

namespace App\Review\Domain\Entity;

use App\Game\Domain\Entity\Game;
use App\Review\Infrastructure\Repository\CommentRepository;
use App\User\Domain\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\ManyToOne(targetEntity: Game::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Game $game;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeImmutable $createdAt;

    public function __construct(Uuid $id, User $user, Game $game, string $content, \DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->user = $user;
        $this->game = $game;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }
}
