<?php


namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{

    /**
     * @Route("/api/user/remove", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function removeUser(Request $request)
    {
        $params = json_decode($request->getContent());
        $userRepository = $this->getDoctrine()->getRepository('App:User');
        if ($user = $userRepository->findOneBy(['username' => $params->username])) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
            return $this->json("OK");
        }
        return $this->json('User existed', Response::HTTP_NOT_FOUND);
    }

}