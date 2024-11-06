<?php


namespace App\Tests\Controller\Contact;

use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function testContact(ControllerTester $I): void{
        $I->amOnPage('/index.php/contact');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Liste des contacts');
        $I->see('Liste des contacts', 'h1');
        $I->seeNumberOfElements('ul > li', 195);
    }

    public function testRouteContact(ControllerTester $I): void{
        $I->amOnPage('/contact');
        $I->click('ul > li > a[href]');
        $I->seeCurrentRouteIs('app_contact_show');
    }
}
