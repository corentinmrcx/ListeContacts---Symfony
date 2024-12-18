<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function configureAssets(Assets $assets): Assets
    {
        return Assets::new()
            ->addCssFile('https://fonts.googleapis.com/icon?family=Material+Icons');
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('lastname'),
            TextField::new('firstname'),
            TextField::new('email'),
            ArrayField::new('roles')
                ->formatValue(function ($value) {
                    $icons = [];
                    if (in_array('ROLE_ADMIN', $value)) {
                        $icons[] = '<span class="material-icons" title="Admin">manage_accounts</span>';
                    }
                    if (in_array('ROLE_USER', $value)) {
                        $icons[] = '<span class="material-icons" title="User">person</span>';
                    }

                    return implode(' ', $icons) ?: '';
                }),
            TextField::new('password')
                ->hideOnIndex()
                ->setFormType(PasswordType::class)
                ->setRequired(false)
                ->setFormTypeOptions(['mapped' => false, 'empty_data' => '', 'attr' => ['autocomplete' => 'new-password']]),
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPassword($entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    private function setUserPassword($entityInstance): void
    {
        $password = $this->getContext()->getRequest()->get('User')['password'];
        if ('' !== $password) {
            $entityInstance->setPassword($this->passwordHasher->hashPassword($entityInstance, $password));
        }
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->setUserPassword($entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }
}
