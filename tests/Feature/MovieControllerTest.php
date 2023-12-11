<?php

namespace Tests\Feature;

use App\Repository\MovieRepository;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    public function testGetRandomByNumberEndpoint()
    {
        $response = $this->get('/api/v1/movies?action=getRandomByNumber');

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    public function testGetByLetterAndPair()
    {
        $response = $this->get('/api/v1/movies?action=getByLetterAndPair');

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    public function testGetByMoreThenOneWord()
    {
        $response = $this->get('/api/v1/movies?action=getByMoreThenOneWord');

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    public function testWrongParam()
    {
        $response = $this->get('/api/v1/movies?action=custom');
        $response->assertStatus(400);
    }

    public function test404()
    {
        $response = $this->get('hello');
        $response->assertStatus(404);
    }

    public function testCloseAnyRoutes()
    {
        $response = $this->get('/any');
        $response->assertStatus(404);
    }
}
