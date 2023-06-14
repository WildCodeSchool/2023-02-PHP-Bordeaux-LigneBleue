<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $userSuperAdmin = new User();
        $userSuperAdmin->setLevel(1);
        $userSuperAdmin->setFirstname($faker->firstName);
        $userSuperAdmin->setLastname($faker->lastName);
        $userSuperAdmin->setBirthday($faker->dateTimeBetween('-50 years', '-18 years'));
        $userSuperAdmin->setGender('man');
        $userSuperAdmin->setZipcode($faker->numberBetween(10000, 99999));
        $userSuperAdmin->setEmail($faker->email);
        $userSuperAdmin->setPassword($this->passwordHasher->hashPassword($userSuperAdmin, 'admin'));
        $userSuperAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($userSuperAdmin);


        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setLevel(1);
            $user->setBirthday($faker->dateTimeBetween('-50 years', '-18 years'));
            $user->setGender('man');
            $user->setZipcode($faker->numberBetween(10000, 99999));
            $user->setEmail($faker->email);
            $user->setPassword($this->passwordHasher->hashPassword($user, 'test'));
            $manager->persist($user);
        }
        $manager->flush();
    }
}
