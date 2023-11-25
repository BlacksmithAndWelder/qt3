<?php
use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * Verifica se as colunas do modelo User estão corretas.
     *
     * @return void
     */
    public function test_check_if_user_columns_are_correct()
    {
        $user = new User;
        $expected = [
            'name',
            'email',
            'password',
            'email_verified_at',
            'remember_token',
        ];

        $arrayCompared = array_diff($expected, $user->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
