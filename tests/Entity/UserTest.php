<?php

namespace App\Tests\Util;

namespace App\Entity;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetRoles()
    {
        // verifier qu'un nouvel utilisateur créé a bien par défaut le rôle 'ROLE_USER'
        $user = new User();
        $result = $user->getRoles();
        $this->assertEquals(['ROLE_USER'], $result);

        // verifier que lorsque on ajoute un nouveau rôle à l'utilisateur, il conserve bien le rôle 'ROLE_USER'
        $result = $user->setRoles(['ROLE_ADMIN']);
        $result = $user->getRoles();
        $this->assertEquals(['ROLE_ADMIN', 'ROLE_USER'], $result);
    }
}
