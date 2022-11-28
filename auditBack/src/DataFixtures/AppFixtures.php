<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\Assistante;
use App\Entity\Controleur;
use App\Entity\Coordonateur;
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

        $coordonateur = new Coordonateur();
        $profilCoordonateur=new Profil();
        $profilCoordonateur->setLibelle("COORDONATEUR");
        $coordonateur->setUsername("coordonateur1");
        $coordonateur->setProfil($profilCoordonateur);
        $coordonateur->setPrenom("Monsieur");
        $coordonateur->setRoles(["COORDONATEUR"]);
        $coordonateur->setNom("SYLLA");
        $coordonateur->setMatricule("1");
        $coordonateur->setDateAjout("01/10/2020");
        $coordonateur->setEmail("monsieursylla@gmail.com");
        $password = $this->passwordEncoder->encodePassword($coordonateur, 'Password@123');
        $coordonateur->setPassword($password);

        $controleur1 = new Controleur();
        $profilControleur=new Profil();
        $profilControleur->setLibelle("CONTROLEUR");
        $controleur1->setUsername("controleur1");
        $controleur1->setRoles(["CONTROLEUR"]);
        $controleur1->setProfil($profilControleur);
        $controleur1->setPrenom("Issa SARR");
        $controleur1->setNom("TRAVEAUX");
        $controleur1->setMatricule("2");
        $controleur1->setDateAjout("02/10/2020");
        $controleur1->setEmail("issasarr@gmail.com");
        $password = $this->passwordEncoder->encodePassword($controleur1, 'Password@123');
        $controleur1->setPassword($password);

        $controleur2 = new Controleur();
        $controleur2->setUsername("controleur2");
        $controleur2->setRoles(["CONTROLEUR"]);
        $controleur2->setProfil($profilControleur);
        $controleur2->setPrenom("Cheikh Ibra DIOP");
        $controleur2->setNom("FATURE");
        $controleur2->setMatricule("3");
        $controleur2->setDateAjout("03/10/2020");
        $controleur2->setEmail("cheikhibra@gmail.com");
        $password = $this->passwordEncoder->encodePassword($controleur2, 'Password@123');
        $controleur2->setPassword($password);

        $controleur3 = new Controleur();
        $controleur3->setUsername("controleur3");
        $controleur3->setRoles(["CONTROLEUR"]);
        $controleur3->setProfil($profilControleur);
        $controleur3->setPrenom("Ndeye Gnilane FAYE");
        $controleur3->setNom("MEDICALE");
        $controleur3->setMatricule("4");
        $controleur3->setDateAjout("04/10/2020");
        $controleur3->setEmail("gnilane@gmail.com");
        $password = $this->passwordEncoder->encodePassword($controleur3, 'Password@123');
        $controleur3->setPassword($password);

        $assistante = new Assistante();
        $profilAssistante=new Profil();
        $profilAssistante->setLibelle("ASSISTANTE");
        $assistante->setUsername("assistante1");
        $assistante->setRoles(["ASSISTANTE"]);
        $assistante->setProfil($profilAssistante);
        $assistante->setPrenom("Madame");
        $assistante->setNom("SENE");
        $assistante->setMatricule("5");
        $assistante->setDateAjout("05/10/2020");
        $assistante->setEmail("madamesene@gmail.com");
        $password = $this->passwordEncoder->encodePassword($assistante, 'Password@123');
        $assistante->setPassword($password);


        $manager->persist($assistante);
        $manager->persist($coordonateur);
        $manager->persist($controleur1);
        $manager->persist($controleur2);
        $manager->persist($controleur3);
        $manager->flush();
    }
}
