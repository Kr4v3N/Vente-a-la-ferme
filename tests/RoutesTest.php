<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class RoutesTest extends TestCase
{


    public function ClientUser()
    {

        $client = 'ROLE_ADMIN';


    }

    public function testAdminCanAccessAllRoutes($url)
    {

        $client = $this->ClientAdmin();

        //$this->assertTrue(true);
    }
}
