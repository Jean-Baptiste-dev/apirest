<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GraphQl\Operation;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post as PostData;
use ApiPlatform\Metadata\Put;
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ApiResource(
    /*
    Operation: [
        new GetCollection(normalizationContext: ['groups' => 'post:list']),
        new Get(normalizationContext: ['groups' => 'post:item']),
        new Patch(),
        new Delete(),
        new Put(),
        new PostData(),
    ],
    */)]

class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['post:list', 'post:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['post:list', 'post:item'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['post:list', 'post:item'])]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['post:list', 'post:item'])]
    private ?string $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }
}
