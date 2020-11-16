<?php

namespace App\Controller;

use App\Entity\MicroserviceC;
use App\Repository\MicroserviceCRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MicroserviceCController extends AbstractController
{
    /**
     * @Route("/microservice_c", name="microservice_c")
     * @param MicroserviceCRepository $repository
     * @return Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function microservice(MicroserviceCRepository $repository): Response
    {
//        $grpcClient = new MyGrpcClient('http://microservice-c', [
//            'credentials' => \Grpc\ChannelCredentials::createInsecure(),
//        ]);

        $analytics = $repository->findAll();
        return $this->render('microservice_c/microservice.html.twig', [
            'analytics' => $analytics
        ]);
    }
}
