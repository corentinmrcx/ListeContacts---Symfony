<?php

namespace App\Factory;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Persistence\Proxy;
use Zenstruck\Foundry\Persistence\ProxyRepositoryDecorator;

/**
 * @extends PersistentProxyObjectFactory<Contact>
 *
 * @method        Contact|Proxy                              create(array|callable $attributes = [])
 * @method static Contact|Proxy                              createOne(array $attributes = [])
 * @method static Contact|Proxy                              find(object|array|mixed $criteria)
 * @method static Contact|Proxy                              findOrCreate(array $attributes)
 * @method static Contact|Proxy                              first(string $sortedField = 'id')
 * @method static Contact|Proxy                              last(string $sortedField = 'id')
 * @method static Contact|Proxy                              random(array $attributes = [])
 * @method static Contact|Proxy                              randomOrCreate(array $attributes = [])
 * @method static ContactRepository|ProxyRepositoryDecorator repository()
 * @method static Contact[]|Proxy[]                          all()
 * @method static Contact[]|Proxy[]                          createMany(int $number, array|callable $attributes = [])
 * @method static Contact[]|Proxy[]                          createSequence(iterable|callable $sequence)
 * @method static Contact[]|Proxy[]                          findBy(array $attributes)
 * @method static Contact[]|Proxy[]                          randomRange(int $min, int $max, array $attributes = [])
 * @method static Contact[]|Proxy[]                          randomSet(int $number, array $attributes = [])
 */
final class ContactFactory extends PersistentProxyObjectFactory
{
    private $transliterator;

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
        $this->transliterator = \Transliterator::create('Any-Lower; Latin-ASCII');
    }

    public static function class(): string
    {
        return Contact::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function defaults(): array|callable
    {
        $firstname = self::faker()->firstName();
        $lastname = self::faker()->lastName();
        $mailFirstName = $this->normalizeName($firstname);
        $mailLastName = $this->normalizeName($lastname);
        $phone = self::faker()->phoneNumber();

        return [
            'email' => $mailFirstName.'.'.$mailLastName.'@'.self::faker()->domainName(),
            'firstname' => $firstname,
            'lastname' => $lastname,
        ];
    }

    protected function normalizeName(string $name): string
    {
        return preg_replace('/[^a-z]/', '-', mb_strtolower($this->transliterator->transliterate($name)));
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Contact $contact): void {})
        ;
    }
}
