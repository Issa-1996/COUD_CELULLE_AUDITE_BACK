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
        for($i=0; $i<5; $i++){
            $role= ["ROLE_ADMIN"];
            $user=new User();
            $user->setUsername("admin".($i+1));
            $user->setRoles($role);
            $user->setProfil("Controleurs".$i);
            $user->setPrenom("Issa".$i);
            $user->setNom("SARR");
            $user->setMatricule($i);
            $user->setDateDeNaissance("10/10/2020");
            $user->setEmail("issa.cheikhbi.gnilane@gmail.com");
    
            $password = $this->passwordEncoder->encodePassword($user,'password');
            $user->setPassword($password);
    
            $manager->persist($user);
        }
        $manager->flush();
    }
}
