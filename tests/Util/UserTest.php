<?php

namespace App\Tests\Util;

namespace App\Entity;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetRoles()
    {
        $user = new User();
        $result = $user->getRoles();

        $this->assertEquals(['ROLE_USER'], $result);
    }
}
