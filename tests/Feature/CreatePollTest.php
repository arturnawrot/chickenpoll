<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreatePollTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreatesAPoll()
    {
        $this->withoutMiddleware();

        $response = $this->post('/poll', [
            'title' => "What's your favorite color?",
            'options' => ['Red', 'Blue', 'Green'],
            'settings' => ['recaptcha' => 0, 'ip_checking' => 1, 'cookie_checking' => 0]
        ]);

        $response->assertStatus(200);
    }
}