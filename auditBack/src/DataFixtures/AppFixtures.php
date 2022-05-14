<?php

namespace App\DataFixtures;

use App\Entity\Coordinateur;
use App\Entity\Profil;
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
            $role= ["ROLE_COORDINATEUR"];
            $user=new Coordinateur();
            $profil=new Profil();
            $profil->setLibelle("COORDINATEUR");
            $user->setUsername("admin");
            $user->setRoles($role);
            $user->setProfil($profil);
            $user->setPrenom("Issa");
            $user->setNom("SARR");
            $user->setMatricule("23456");
            $user->setDateDeNaissance("10/10/2020");
            $user->setEmail("issa.cheikhbi.gnilane@gmail.com");
            $password = $this->passwordEncoder->encodePassword($user,'password');
            $user->setPassword($password);

            $profilCont=new Profil();
            $profilCont->setLibelle("CONTROLEURS");

            $profilAssist=new Profil();
            $profilAssist->setLibelle("ASSISTANTE");
    
            $manager->persist($user);
            $manager->persist($profilCont);
            $manager->persist($profilAssist);
            $manager->flush();
    }
}
