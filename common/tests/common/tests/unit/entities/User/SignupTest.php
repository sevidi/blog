<?php


namespace common\tests\unit\entities\User;

use Codeception\Test\Unit;
use post\entities\User\User;

class SignupTest extends Unit
{
    public function testSuccess()
    {
        $user = new User(
            $username = 'username',
            $email = 'email@site.com',
            $password = 'password'
        );

        $this->assertEquals($username, $user->username);
        $this->assertEquals($email, $user->email);
        $this->assertNotEmpty($user->password_hash);
        $this->assertNotEquals($password, $user->password_hash);
        $this->assertNotEmpty($user->created_at);
        $this->assertNotEmpty($user->auth_key);
        $this->assertEquals(User::STATUS_ACTIVE, $user->status);
    }

}