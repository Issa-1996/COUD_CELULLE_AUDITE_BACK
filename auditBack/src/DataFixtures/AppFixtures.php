<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\Assistante;
use App\Entity\Controleurs;
use App\Entity\Coordinateur;
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
            $coordinateur=new Coordinateur();
            $profilCoordinateur=new Profil();
            $profilCoordinateur->setLibelle("COORDINATEUR");
            $coordinateur->setUsername("admin1");
            $coordinateur->setRoles(["ROLE_COORDINATEUR"]);
            $coordinateur->setProfil($profilCoordinateur);
            $coordinateur->setPrenom("Issa");
            $coordinateur->setNom("SARR");
            $coordinateur->setMatricule("23456");
            $coordinateur->setDateDeNaissance("10/10/2020");
            $coordinateur->setEmail("issa@gmail.com");
            $password = $this->passwordEncoder->encodePassword($coordinateur,'password');
            $coordinateur->setPassword($password);

            $controleurs=new Controleurs();
            $profilControleurs=new Profil();
            $profilControleurs->setLibelle("CONTROLEURS");
            $controleurs->setUsername("admin2");
            $controleurs->setRoles(["ROLE_CONTROLEURS"]);
            $controleurs->setProfil($profilControleurs);
            $controleurs->setPrenom("Cheikh Ibra");
            $controleurs->setNom("DIOP");
            $controleurs->setMatricule("123456");
            $controleurs->setDateDeNaissance("10/10/2020");
            $controleurs->setEmail("coud@gmail.com");
            $password = $this->passwordEncoder->encodePassword($controleurs,'password');
            $controleurs->setPassword($password);

            $assistante=new Assistante();
            $profilAssistante=new Profil();
            $profilAssistante->setLibelle("ASSISTANTE");
            $assistante->setUsername("admin3");
            $assistante->setRoles(["ROLE_ASSISTANTE"]);
            $assistante->setProfil($profilAssistante);
            $assistante->setPrenom("Cheikh Ibra");
            $assistante->setNom("DIOP");
            $assistante->setMatricule("123456");
            $assistante->setDateDeNaissance("10/10/2020");
            $assistante->setEmail("coud@gmail.com");
            $password = $this->passwordEncoder->encodePassword($assistante,'password');
            $assistante->setPassword($password);

    
            $manager->persist($assistante);
            $manager->persist($controleurs);
            $manager->persist($coordinateur);
            $manager->flush();
    }
}
