<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('mehdi-mebarki@live.fr');
        $user->setName('mehdi');
        $user->setLastname('mebarki');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'mehdi'
        ));


        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('younes-mebarki@live.fr');
        $user2->setName('younes');
        $user2->setLastname('mebarki');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            'younes'
        ));


        // $product = new Product();

        $manager->persist($user2);

        $manager->flush();
    }
}
