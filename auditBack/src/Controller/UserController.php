<?php

namespace App\Controller;

use App\Repository\ProfilRepository;
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

    public function  __construct(EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, 
    SerializerInterface $serializer, ProfilRepository $profilRepo)
    {
        $this->manager = $manager;
        $this->encoder = $encoder;
        $this->serialize = $serializer;
        $this->profilRepo = $profilRepo;
    }
    /**
     * @Route("/api/coud/currentUser", name="currentUser")
     */
    public function  currentUser(SerializerInterface $serializer,TokenStorageInterface $tokenStorage){
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
    public function addUser(ProfilRepository $profilRepo ,UserPasswordEncoderInterface $encoder,Request $request,SerializerInterface $serializer)
    {
        $user=json_decode($request->getContent(), true);
        $profilObjet=$profilRepo->find($user["profil"]);
        $profilLibelle = trim($profilObjet->getLibelle());
        $profil="App\\Entity\\$profilLibelle";
        if(class_exists(($profil))){
            $user = $this->serialize->denormalize($user,$profil);
            $user->setProfil($profilObjet);
            $password = $user->getPassword();
            $user->setPassword($this->encoder->encodePassword($user,$password));
            
            $this->manager->persist($user);
            $this->manager->flush();
            return new JsonResponse("success", Response::HTTP_OK);
        }
        return "le profil ne connait pas";
    }
}