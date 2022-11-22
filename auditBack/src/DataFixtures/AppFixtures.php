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
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager): void
    {

        $coordinateur = new Coordinateur();
        $profilCoordonateur=new Profil();
        $profilCoordonateur->setLibelle("COORDONATEUR");
        $coordinateur->setUsername("coordonateur1");
        $coordinateur->setProfil($profilCoordonateur);
        $coordinateur->setPrenom("Monsieur");
        $coordinateur->setRoles(["ROLE_COORDONATEUR"]);
        $coordinateur->setNom("SYLLA");
        $coordinateur->setMatricule("1");
        $coordinateur->setDateAjout("01/10/2020");
        $coordinateur->setEmail("monsieursylla@gmail.com");
        $password = $this->passwordEncoder->encodePassword($coordinateur, 'password');
        $coordinateur->setPassword($password);

        $controleurs1 = new Controleurs();
        $profilControleur=new Profil();
        $profilControleur->setLibelle("CONTROLEUR");
        $controleurs1->setUsername("controleur1");
        $controleurs1->setRoles(["ROLE_CONTROLEUR"]);
        $controleurs1->setProfil($profilControleur);
        $controleurs1->setPrenom("Issa SARR");
        $controleurs1->setNom("TRAVEAUX");
        $controleurs1->setMatricule("2");
        $controleurs1->setDateAjout("02/10/2020");
        $controleurs1->setEmail("issasarr@gmail.com");
        $password = $this->passwordEncoder->encodePassword($controleurs1, 'password');
        $controleurs1->setPassword($password);

        $controleurs2 = new Controleurs();
        $controleurs2->setUsername("controleur2");
        $controleurs2->setRoles(["ROLE_CONTROLEUR"]);
        $controleurs2->setProfil($profilControleur);
        $controleurs2->setPrenom("Cheikh Ibra DIOP");
        $controleurs2->setNom("FATURE");
        $controleurs2->setMatricule("3");
        $controleurs2->setDateAjout("03/10/2020");
        $controleurs2->setEmail("cheikhibra@gmail.com");
        $password = $this->passwordEncoder->encodePassword($controleurs2, 'password');
        $controleurs2->setPassword($password);

        $controleurs3 = new Controleurs();
        $controleurs3->setUsername("controleur3");
        $controleurs3->setRoles(["ROLE_CONTROLEUR"]);
        $controleurs3->setProfil($profilControleur);
        $controleurs3->setPrenom("Ndeye Gnilane FAYE");
        $controleurs3->setNom("MEDICALE");
        $controleurs3->setMatricule("4");
        $controleurs3->setDateAjout("04/10/2020");
        $controleurs3->setEmail("gnilane@gmail.com");
        $password = $this->passwordEncoder->encodePassword($controleurs3, 'password');
        $controleurs3->setPassword($password);

        $assistante = new Assistante();
        $profilAssistante=new Profil();
        $profilAssistante->setLibelle("ASSISTANTE");
        $assistante->setUsername("assistante1");
        $assistante->setRoles(["ROLE_ASSISTANTE"]);
        $assistante->setProfil($profilAssistante);
        $assistante->setPrenom("Madame");
        $assistante->setNom("SENE");
        $assistante->setMatricule("5");
        $assistante->setDateAjout("05/10/2020");
        $assistante->setEmail("madamesene@gmail.com");
        $password = $this->passwordEncoder->encodePassword($assistante, 'password');
        $assistante->setPassword($password);


        $manager->persist($assistante);
        $manager->persist($coordinateur);
        $manager->persist($controleurs1);
        $manager->persist($controleurs2);
        $manager->persist($controleurs3);
        $manager->flush();
    }
}
