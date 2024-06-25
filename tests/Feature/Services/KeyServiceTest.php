<?php

namespace Tests\Feature\Services;

use Tests\TestCase;

class KeyServiceTest extends TestCase
{
    public function test_the_key_service_returns_a_valid_encrypted_key(): void
    {
        $key = \App\Services\KeyService::generateKey('example.com');
        $this->assertIsString($key);
    }
}
