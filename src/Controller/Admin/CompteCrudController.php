<?php

namespace App\Controller\Admin;

use App\Entity\Collectivite;
use App\Entity\Compte;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Compte::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Prenom'),
            TextField::new('Nom'),
            EmailField::new('Mail'),
            BooleanField::new('Referent'),
            DateTimeField::new('updatedAt')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm()

        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Compte) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable);
        parent::persistEntity($entityManager, $entityInstance);
    }
}
