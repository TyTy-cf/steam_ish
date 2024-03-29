<?php

namespace App\Entity;

use App\Repository\GameRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DrosalysWeb\ObjectExtensions\Slug\Model\SlugInterface;
use DrosalysWeb\ObjectExtensions\Slug\Model\SlugMethodsTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[UniqueEntity(fields: 'name', message: 'account.constraints.unique.name')]
#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game implements  SlugInterface
{

    use SlugMethodsTrait;

    #[ORM\Id, ORM\GeneratedValue('AUTO'), ORM\Column(type: 'integer')]
    #[Groups(['Game'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['Game'])]
    private ?string $name;

    #[ORM\Column(type: 'float')]
    #[Groups(['Game'])]
    private float $price;

    #[ORM\Column(type: 'datetime')]
    #[Groups(['Game'])]
    private DateTime $publishedAt;

    #[ORM\Column(type: 'text')]
    #[Groups(['Game'])]
    private string $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['Game'])]
    private ?string $thumbnailCover;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['Game'])]
    private ?string $thumbnailLogo;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Groups(['Account'])]
    private string $slug = '';

    #[ORM\ManyToMany(targetEntity: Country::class, inversedBy: 'games')]
    #[Groups(['Game'])]
    private Collection $countries;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'games')]
    #[Groups(['Game'])]
    private Collection $genres;

    #[ORM\OneToMany(mappedBy: 'game', targetEntity: Comment::class)]
    #[Groups(['Game'])]
    private Collection $comments;

    #[ORM\ManyToOne(targetEntity: Publisher::class, inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['Game'])]
    private ?Publisher $publisher;

    public function __construct()
    {
        $this->countries = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getThumbnailCover(): ?string
    {
        return $this->thumbnailCover;
    }

    public function setThumbnailCover(string $thumbnailCover): self
    {
        $this->thumbnailCover = $thumbnailCover;

        return $this;
    }

    public function getThumbnailLogo(): ?string
    {
        return $this->thumbnailLogo;
    }

    public function setThumbnailLogo(?string $thumbnailLogo): self
    {
        $this->thumbnailLogo = $thumbnailLogo;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCountries(): Collection
    {
        return $this->countries;
    }

    public function addCountry(Country $country): self
    {
        if (!$this->countries->contains($country)) {
            $this->countries[] = $country;
        }

        return $this;
    }

    public function removeCountry(Country $country): self
    {
        $this->countries->removeElement($country);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        $this->comments->removeElement($comment);

        return $this;
    }

    public function getPublisher(): ?Publisher
    {
        return $this->publisher;
    }

    public function setPublisher(?Publisher $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getPublishedAt(): DateTime
    {
        return $this->publishedAt;
    }

    /**
     * @param DateTime $publishedAt
     * @return Game
     */
    public function setPublishedAt(DateTime $publishedAt): Game
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    public static function getSlugFields(): array
    {
        return [
            'name',
        ];
    }

}
