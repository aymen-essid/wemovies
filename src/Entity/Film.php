<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $adult = null;

    #[ORM\Column(length: 255)]
    private ?string $backdrop_path = null;

    #[ORM\Column(length: 255)]
    private ?string $original_language = null;

    #[ORM\Column(length: 255)]
    private ?string $original_title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $overview = null;

    #[ORM\Column]
    private ?float $popularity = null;

    #[ORM\Column(length: 255)]
    private ?string $poster_path = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?bool $video = null;

    #[ORM\Column]
    private ?float $vote_average = null;

    #[ORM\Column]
    private ?int $vote_count = null;

    /**
     * @var Collection<int, Gender>
     */
    #[ORM\ManyToMany(targetEntity: Gender::class, inversedBy: 'films')]
    private Collection $genre_ids;

    public function __construct()
    {
        $this->genre_ids = new ArrayCollection();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function isAdult(): ?bool
    {
        return $this->adult;
    }

    public function setAdult(bool $adult): static
    {
        $this->adult = $adult;

        return $this;
    }

    public function getBackdropPath(): ?string
    {
        return $this->backdrop_path;
    }

    public function setBackdropPath(string $backdrop_path): static
    {
        $this->backdrop_path = $backdrop_path;

        return $this;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->original_language;
    }

    public function setOriginalLanguage(string $original_language): static
    {
        $this->original_language = $original_language;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->original_title;
    }

    public function setOriginalTitle(string $original_title): static
    {
        $this->original_title = $original_title;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): static
    {
        $this->overview = $overview;

        return $this;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function setPopularity(float $popularity): static
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->poster_path;
    }

    public function setPosterPath(string $poster_path): static
    {
        $this->poster_path = $poster_path;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
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

    public function isVideo(): ?bool
    {
        return $this->video;
    }

    public function setVideo(bool $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getVoteAverage(): ?float
    {
        return $this->vote_average;
    }

    public function setVoteAverage(float $vote_average): static
    {
        $this->vote_average = $vote_average;

        return $this;
    }

    public function getVoteCount(): ?int
    {
        return $this->vote_count;
    }

    public function setVoteCount(int $vote_count): static
    {
        $this->vote_count = $vote_count;

        return $this;
    }

    /**
     * @return Collection<int, Gender>
     */
    public function getGenreIds(): Collection
    {
        return $this->genre_ids;
    }

    public function addGenreId(Gender $genreId): static
    {
        if (!$this->genre_ids->contains($genreId)) {
            $this->genre_ids->add($genreId);
        }

        return $this;
    }

    public function removeGenreId(Gender $genreId): static
    {
        $this->genre_ids->removeElement($genreId);

        return $this;
    }
}
