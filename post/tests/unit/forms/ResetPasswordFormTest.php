<?php


namespace post\tests\unit\forms;

use Codeception\Test\Unit;
use post\forms\auth\ResetPasswordForm;

class ResetPasswordFormTest extends Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function testCorrectToken()
    {
        $form = new ResetPasswordForm();
        $form->password = 'new-password';
        expect_that($form->validate());
    }

}