<?php

namespace App\Tests\Controller\Contact;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class CreateCest
{
    public function formShowsContactCreationPage(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN']]);
        $admin = $user->_real();

        $I->amLoggedInAs($admin);

        $I->amOnPage('/contact/create');

        $I->seeInTitle("Création d'un nouveau contact");
        $I->see("Création d'un nouveau contact", 'h1');
        $I->seeElement('form');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $I->amOnPage('/contact/create');
        $I->seeCurrentUrlEquals('/login');
    }
}
