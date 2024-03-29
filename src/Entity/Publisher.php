<?php

namespace App\Entity;

use App\Repository\PublisherRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DrosalysWeb\ObjectExtensions\Slug\Model\SlugInterface;
use DrosalysWeb\ObjectExtensions\Slug\Model\SlugMethodsTrait;
use DrosalysWeb\ObjectExtensions\Timestamp\Model\CreatedTimestampInterface;
use DrosalysWeb\ObjectExtensions\Timestamp\Model\CreatedTimestampMethodsTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[UniqueEntity(fields: 'name', message: 'account.constraints.unique.name')]
#[ORM\Entity(repositoryClass: PublisherRepository::class)]
class Publisher implements SlugInterface, CreatedTimestampInterface
{

    use CreatedTimestampMethodsTrait;
    use SlugMethodsTrait;

    #[ORM\Id, ORM\GeneratedValue('AUTO'), ORM\Column(type: 'integer')]
    #[Groups(['Publisher'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: '180')]
    #[Groups(['Publisher'])]
    private string $name;

    #[ORM\Column(type: 'string', length: '180')]
    #[Groups(['Publisher'])]
    private string $website;

    #[ORM\ManyToOne(targetEntity: Country::class)]
    #[Groups(['Publisher'])]
    private Country $country;

    #[ORM\OneToMany(mappedBy: 'publisher', targetEntity: Game::class)]
    #[Groups(['Publisher'])]
    private Collection $games;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    #[Groups(['Account'])]
    private string $slug = '';

    #[ORM\Column(type: 'datetime')]
    #[Groups(['Account'])]
    protected DateTime $createdAt;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCountry(): Country
    {
        return $this->country;
    }

    public function setCountry(Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setPublisher($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getPublisher() === $this) {
                $game->setPublisher(null);
            }
        }

        return $this;
    }

    public static function getSlugFields(): array
    {
        return [
            'name',
        ];
    }
}
