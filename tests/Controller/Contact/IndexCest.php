<?php

namespace App\Tests\Controller\Contact;

use App\Factory\ContactFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function testContact(ControllerTester $I): void
    {
        ContactFactory::createMany(5);
        $I->amOnPage('/contact');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeInTitle('Liste des contacts');
        $I->see('Liste des contacts', 'h1');
        $I->seeNumberOfElements('ul.contacts > li > a', 5);
    }

    public function trieContact(ControllerTester $I): void
    {
        ContactFactory::createSequence(
            [
                ['firstname' => 'Louis', 'lastname' => 'Baudat'],
                ['firstname' => 'Romain', 'lastname' => 'Lobreau'],
                ['firstname' => 'Romaric', 'lastname' => 'Perichard'],
                ['firstname' => 'Tristan', 'lastname' => 'Lobreau'],
                ['firstname' => 'Karim', 'lastname' => 'Rysman'],
            ]
        );

        $I->AmOnPage('/contact');
        $contacts = $I->grabMultiple('ul.contacts > li > a');
        $ordreAttendu = [
            'Baudat Louis',
            'Lobreau Romain',
            'Lobreau Tristan',
            'Perichard Romaric',
            'Rysman Karim',
        ];
        $I->assertEquals($ordreAttendu, $contacts);
    }

    public function testContactPage(ControllerTester $I): void
    {
        $contact = ContactFactory::createOne(['firstname' => 'Joe',  'lastname' => 'Aaaaaaaaaaaaaaa']);
        ContactFactory::createMany(5);
        $I->amOnPage('/contact');
        $I->click('Aaaaaaaaaaaaaaa Joe');
        $I->seeResponseCodeIsSuccessful(200);
        $I->seeCurrentRouteIs('app_contact_show', ['id' => $contact->getId()]);
    }

    public function testSearchMethod(ControllerTester $I)
    {
        $contact1 = ContactFactory::createOne(['firstname' => 'Lototo',  'lastname' => 'Baudat']);
        $contact2 = ContactFactory::createOne(['firstname' => 'Romain', 'lastname' => 'Lobtoto']);
        $contact3 = ContactFactory::createOne(['firstname' => 'Romaric',  'lastname' => 'Périchard']);
        $contact4 = ContactFactory::createOne(['firstname' => 'Tristan', 'lastname' => 'Audinot']);

        $I->amOnPage('/contact');

        $search = 'to';
        $I->fillField('search', $search);
        $I->click('Rechercher');

        $I->see('Baudat', 'ul.contacts > li > a > span.lastname');
        $I->see('Lototo', 'ul.contacts > li > a > span.firstname');

        $I->see('Lobtoto', 'ul.contacts > li > a > span.lastname');
        $I->see('Romain', 'ul.contacts > li > a > span.firstname');

        $I->dontSee('Périchard', 'ul.contacts > li > a > span.lastname');
        $I->dontSee('Audinot', 'ul.contacts > li > a > span.lastname');
    }

}
