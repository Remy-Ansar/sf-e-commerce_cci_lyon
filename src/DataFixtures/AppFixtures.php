<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct(
        private UserPasswordHasherInterface $hasher,
    ) {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = (new User)
            ->setFirstName('Remy')
            ->setLastName('Ansar')
            ->setEmail('remy@test.com')
            ->setPassword(
                $this->hasher->hashPassword(new User, 'Test1234!')
            )
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $user = (new User)
                ->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName())
                ->setEmail($this->faker->unique()->email())
                ->setPassword(
                    $this->hasher->hashPassword(new User, 'Test1234!'),
                )
                ->setRoles(
                    $this->faker->randomElements(['ROLE_USER', 'ROLE_ADMIN', 'ROLE_EDITOR'], null)
                );

            $manager->persist($user);
        }
        $manager->flush();
    }
}
