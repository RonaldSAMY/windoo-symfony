<?php

namespace App\Controller;

use JMS\Serializer\SerializerInterface;
use JMS\SerializerBundle\DependencyInjection\JMSSerializerExtension;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserController extends AbstractController
{

    /**
     * @Route("/user/login", name="user_login")
     */
    public function index(\Symfony\Component\Serializer\SerializerInterface $poSerializer)
    {
        return new Response($poSerializer->serialize($this->getUser(),'json'),Response::HTTP_FOUND);
    }
}
