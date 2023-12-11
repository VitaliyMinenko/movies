<?php
declare(strict_types=1);

namespace App\Repository;

use App\DataSources\MovieSource;
use Illuminate\Support\Collection;

class MovieRepository
{
    private MovieSource $movieSource;

    public function __construct(MovieSource $movieSource)
    {
        $this->movieSource = $movieSource;
    }

    /**
     * @param int $numberOfRandomCollections
     *
     * @return Collection
     */
    public function getRandomByNumber(int $numberOfRandomCollections = 3): Collection
    {
        $movies = $this->movieSource
            ->getMovies()
            ->unique();
        return $this->getRandomMovies($movies, new Collection(), $numberOfRandomCollections);
    }

    /**
     * @param Collection $allMoviesCollection
     * @param Collection $randomMovies
     * @param int        $numberOfRandomModels
     *
     * @return Collection
     */
    private function getRandomMovies(Collection $allMoviesCollection, Collection $randomMovies, int $numberOfRandomModels): Collection
    {
        if ($numberOfRandomModels > 0 && $allMoviesCollection->isNotEmpty()) {
            $randomMovie = $allMoviesCollection->random();
            $randomMovies->push($randomMovie);
            $allMoviesCollection->forget($allMoviesCollection->search($randomMovie));
            return $this->getRandomMovies($allMoviesCollection, $randomMovies, $numberOfRandomModels - 1);
        }
        return $randomMovies;
    }

    /**
     * @param string $letter
     *
     * @return Collection
     */
    public function getByLetterAndPair(string $letter = 'W'): Collection
    {
        return $this->movieSource
            ->getMovies()
            ->unique()
            ->filter(function ($movie) use ($letter){
                return str_starts_with(mb_strtolower($movie), mb_strtolower($letter)) && mb_strlen($movie) % 2 == 0;
        });
    }

    /**
     * @return Collection
     */
    public function getByMoreThenOneWord(): Collection
    {
        return $this->movieSource
            ->getMovies()
            ->unique()
            ->filter(function ($movie){
            return count(explode(" ", trim($movie))) >= 2;
        });
    }
}