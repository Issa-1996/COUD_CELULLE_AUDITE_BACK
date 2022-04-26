<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $role= ["ROLE_ADMIN"];
        $user=new User();
        $user->setUsername("admin");
        $user->setRoles($role);

        $password = $this->passwordEncoder->encodePassword($user,'password');
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
