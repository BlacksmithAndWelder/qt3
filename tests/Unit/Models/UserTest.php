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

        // Atributos fillable
        $fillableExpected = [
            'name',
            'email',
            'password',
        ];

        $fillableCompared = array_diff($fillableExpected, $user->getFillable());
        $this->assertCount(0, $fillableCompared, 'Algumas colunas fillable não correspondem às expectativas.');

        // Atributos hidden
        $hiddenExpected = [
            'password',
            'remember_token',
        ];

        $hiddenCompared = array_diff($hiddenExpected, $user->getHidden());
        $this->assertCount(0, $hiddenCompared, 'Algumas colunas hidden não correspondem às expectativas.');

        // Atributos casts
        $castsExpected = [
            'email_verified_at' => 'datetime',
        ];

        $castsCompared = array_diff_assoc($castsExpected, $user->getCasts());
        $this->assertCount(0, $castsCompared, 'Algumas colunas casts não correspondem às expectativas.');
    }
}
