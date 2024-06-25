<?php

namespace Tests\Feature\Services;

use App\Services\DomainService;
use App\Services\KeyService;
use Tests\TestCase;
class DomainServiceTest extends TestCase
{

    public function test_the_domain_service_returns_a_valid_domain(): void
    {

        $getToken = KeyService::generateKey('example.com');

        $domain = DomainService::validateDomain('example.com', $getToken);
        $this->assertIsBool($domain);
    }

}
