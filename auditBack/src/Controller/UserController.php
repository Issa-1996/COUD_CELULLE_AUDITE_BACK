<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/api/coud/currentUser", name="currentUser")
     */
    public function  currentUser(SerializerInterface $serializer,TokenStorageInterface $tokenStorage){
        //dd("ok");
        $userConnect=$this->getUser();
        //dd($userConnect);
        $user =$serializer->serialize($userConnect,"json");
        return new JsonResponse($user,Response::HTTP_OK,[],true);
       
    }
}
