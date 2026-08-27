<?php

namespace Tests\Feature;

use Tests\TestCase;

class RehabCareSmokeTest extends TestCase
{
    public function test_public_homepage_is_available(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_login_page_is_available(): void
    {
        $this->get('/login')->assertOk();
    }

    public function test_booking_page_is_available(): void
    {
        $this->get('/book')->assertOk();
    }
}
