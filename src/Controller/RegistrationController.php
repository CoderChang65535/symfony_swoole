<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{

    /**
     * @Route("/register",methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function register(Request $request)
    {
        $params = json_decode($request->getContent());
        $userRepository = $this->getDoctrine()->getRepository('App:User');
        if ($user = $userRepository->findOneBy(['username' => $params->username])) {
            return $this->json('User existed', Response::HTTP_BAD_REQUEST);
        } else {
            $em = $this->getDoctrine()->getManager();
            $user = new User();
            $user
                ->setUsername($params->username)
                ->setPlainPassword($params->password)
                ->setEmail($params->email)
                ->setEnabled(true)
                ->setRoles(['ROLE_USER'])
                ->setSuperAdmin(false);
            $em->persist($user);
            $em->flush();
            return $this->json('Success');
        }
    }
}