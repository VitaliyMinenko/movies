<?php

namespace Tests\Unit;

use App\DataSources\MovieSource;
use App\Repository\MovieRepository;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Tests\Helpers\MovieRepositoryHelper;


class MovieRepositoryTest extends TestCase
{

    private $movieSource;
    private $movieService;

    protected function setUp(): void
    {
        $this->movieSource = $this->createMock(MovieSource::class);
        $this->movieService = new MovieRepository($this->movieSource);
    }

    public function testGetRandomMovies()
    {
        $movies = MovieRepositoryHelper::getMovies();
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection($movies));

        $result = $this->movieService->getRandomByNumber();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(3, $result->count());
        foreach ($result->toArray() as $item) {
            $this->assertContains($item, $movies);
        }
    }

    public function testGetRandomByEmptyCollection()
    {
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection());

        $result = $this->movieService->getRandomByNumber();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(0, $result->count());
    }

    public function testGetRandomByNumberOfMovies()
    {
        $countOfMovies = 7;
        $movies = MovieRepositoryHelper::getMovies();
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection($movies));

        $result = $this->movieService->getRandomByNumber($countOfMovies);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($countOfMovies, $result->count());
        foreach ($result->toArray() as $item) {
            $this->assertContains($item, $movies);
        }
    }

    public function testGetRandomBySmallCount()
    {
        $movies = [
            'Pulp fiction', 'Matrix'
        ];
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection($movies));

        $result = $this->movieService->getRandomByNumber();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(count($movies), $result->count());
    }

    public function testGetByLetterAndPair()
    {
        $movies = MovieRepositoryHelper::getMovies();
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection($movies));

        $result = $this->movieService->getByLetterAndPair();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(2, $result->count());
        foreach ($result->toArray() as $item) {
            $this->assertContains($item, $movies);
        }
    }

    public function testGetByLetterAndPairNotPaired()
    {
        $movies = MovieRepositoryHelper::getMovies();
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection([
                'asdfg', 'qwert','1','a34'
            ]));

        $result = $this->movieService->getByLetterAndPair();
        $this->assertEquals(0, $result->count());
    }

    public function testGetByLetterWithAnotherLetter()
    {
        $movies = MovieRepositoryHelper::getMovies();
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection($movies));

        $result = $this->movieService->getByLetterAndPair('D');
        $this->assertEquals(2, $result->count());
        foreach ($result->toArray() as $item) {
            $this->assertContains($item, $movies);
        }
    }

    public function testGetByLetterEmptySource()
    {
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection());

        $result = $this->movieService->getByLetterAndPair();
        $this->assertEquals(0, $result->count());
    }

    public function testGetByMoreThenOneWord()
    {
        $movies = MovieRepositoryHelper::getMovies();
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection($movies));

        $result = $this->movieService->getByMoreThenOneWord();
        $this->assertEquals(6, $result->count());
        foreach ($result->toArray() as $item) {
            $this->assertContains($item, $movies);
        }
    }

    public function testGetByMoreThenOneWordZeroResult()
    {
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection(
                ['one', 'two','three','four', '','']
            ));

        $result = $this->movieService->getByMoreThenOneWord();
        $this->assertEquals(0, $result->count());
    }

    public function testGetByMoreThenOneWordEmpty()
    {
        $this->movieSource->expects($this->once())
            ->method('getMovies')
            ->willReturn(new Collection());

        $result = $this->movieService->getByMoreThenOneWord();
        $this->assertEquals(0, $result->count());
    }
}
