<?php
/**
 * Created by PhpStorm.
 * User: coder
 * Date: 2019-04-22
 * Time: 15:53
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route("/hello",name="hello")
     * @return JsonResponse
     */
    public function hello()
    {
        return $this->json('Hello world');
    }

}