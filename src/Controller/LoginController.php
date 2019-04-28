<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class LoginController extends AbstractController
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoder;

    /**
     * LoginController constructor.
     * @param EncoderFactoryInterface $passwordEncoder
     */
    public function __construct(EncoderFactoryInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    /**
     * @Route("/login",methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login(Request $request)
    {
        $params = json_decode($request->getContent());
        $userRepository = $this->getDoctrine()->getRepository('App:User');
        if ($user = $userRepository->findOneBy(['username' => $params->username])) {
            $encoder = $this->encoder->getEncoder($user);
            if ($encoder->isPasswordValid($user->getPassword(), $params->password, $user->getSalt())) {
                return $this->json('OK');
            }
        }
        return $this->json('Failed', Response::HTTP_UNAUTHORIZED);
    }

}