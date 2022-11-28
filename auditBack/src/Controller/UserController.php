<?php

namespace App\Controller;

use App\Repository\ProfilRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractController
{

    public function  __construct(
        EntityManagerInterface $manager,
        UserPasswordEncoderInterface $encoder,
        SerializerInterface $serializer,
        ProfilRepository $profilRepo
    ) {
        $this->manager = $manager;
        $this->encoder = $encoder;
        $this->serialize = $serializer;
        $this->profilRepo = $profilRepo;
    }
    /**
     * @Route("/api/coud/currentUser", name="currentUser")
     */
    public function  currentUser(SerializerInterface $serializer, TokenStorageInterface $tokenStorage)
    {
        //dd("ok");
        // $userConnect=$this->getUser();
        // dd($userConnect);
        // $user =$serializer->serialize($userConnect, 'json');
        // return new JsonResponse($user,Response::HTTP_OK,[],true);
    }
    /**
     * @Route(
     *      path="/api/coud/users", 
     *      name="user",
     *      methods="POST",
     * )
     */
    public function addUser(\Swift_Mailer $mailer, ProfilRepository $profilRepo, Request $request)
    {
        $user = json_decode($request->getContent(), true);
        $profilObjet = $profilRepo->find($user["profil"]);
        $profilLibelle = trim($profilObjet->getLibelle());
        $profil = "App\\Entity\\$profilLibelle";
        if (class_exists(($profil))) {
            $user = $this->serialize->denormalize($user, $profil);
            $user->setProfil($profilObjet);
            $password = $user->getPassword();
            $user->setPassword($this->encoder->encodePassword($user, $password));
            $message = (new \Swift_Message('COORDONÉES DE CONNEXION '))
                ->setFrom('issa.sarr@uadb.edu.sn')
                ->setTo($user->getEmail())
                ->setBody("CHER " . $user->getPrenom() . "  " . $user->getNom() . ",\nVos identifiants de connexion à la plateforme numerique DU CELLULE AUDIT DE CONTROLE INTERNE sont:\n\nNom d'utilisateur: " . $user->getUsername() . "\nMot de passe provisoire: Password@123\n\nVeillez changer votre mot de passe une fois connecté.");
            $mailer->send($message);
            $this->manager->persist($user);
            $this->manager->flush();
            return new JsonResponse("success", Response::HTTP_OK);
        }
        return "le profil ne connait pas";
    }

    /**
     * @Route(
     *      path="/api/coud/users/{id}", 
     *      name="update",
     *      methods="PUT",
     * )
     */
    public function updateUser(ProfilRepository $profilRepo, Request $request, $id, UserRepository $userRep, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $donnes = json_decode($request->getContent(), true);
        if (isset($donnes["profil"])) {
            $userUpdate = $userRep->find($id);
            $profilObjet = $profilRepo->find($donnes["profil"]);
            $profilLibelle = $profilObjet->getLibelle();
            $profil = "App\\Entity\\$profilLibelle";
            if (class_exists(($profil))) {
                $user = $this->serialize->denormalize($donnes, $profil);

                if (isset($donnes["password"])) {
                    $password = $user->getPassword();
                    $userUpdate->setPassword($this->encoder->encodePassword($user, $password));
                }
                if (isset($donnes["profil"])) {
                    $userUpdate->setProfil($profilObjet);
                    $userUpdate->setRoles([$profilObjet->getLibelle()]);
                }
                if (isset($donnes["prenom"])) {
                    $userUpdate->setPrenom($user->getPrenom());
                }
                if (isset($donnes["nom"])) {
                    $userUpdate->setNom($user->getNom());
                }
                if (isset($donnes["email"])) {
                    $userUpdate->setEmail($user->getEmail());
                }
                if (isset($donnes["dateAjout"])) {
                    $userUpdate->setDateAjout($user->getDateAjout());
                }
                if (isset($donnes["username"])) {
                    $userUpdate->setUsername($user->getUsername());
                }
                if (isset($donnes["matricule"])) {
                    $userUpdate->setMatricule($user->getMatricule());
                }
                $manager->persist($userUpdate);
                $this->manager->flush();
                return new JsonResponse($userUpdate, Response::HTTP_OK);
            }
        } else if (!isset($donnes["profil"])) {
            $userUpdate = $userRep->find($id);
            $profilLibelle = $userUpdate->getProfil()->getLibelle();
            $profil = "App\\Entity\\$profilLibelle";
            if (class_exists(($profil))) {
                $user = $this->serialize->denormalize($donnes, $profil);
                if (isset($donnes["password"])) {
                    $password = $user->getPassword();
                    $userUpdate->setPassword($this->encoder->encodePassword($user, $password));
                }
                if (isset($donnes["prenom"])) {
                    $userUpdate->setPrenom($user->getPrenom());
                }
                if (isset($donnes["nom"])) {
                    $userUpdate->setNom($user->getNom());
                }
                if (isset($donnes["email"])) {
                    $userUpdate->setEmail($user->getEmail());
                }
                if (isset($donnes["dateAjout"])) {
                    $userUpdate->setDateAjout($user->getDateAjout());
                }
                if (isset($donnes["username"])) {
                    $userUpdate->setUsername($user->getUsername());
                }
                if (isset($donnes["matricule"])) {
                    $userUpdate->setMatricule($user->getMatricule());
                }
                $manager->persist($userUpdate);
                $this->manager->flush();
                return new JsonResponse($userUpdate, Response::HTTP_OK);
            }
        }
        return new JsonResponse("ERREUR PROFIL");
    }
}
