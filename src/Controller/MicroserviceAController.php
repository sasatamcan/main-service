<?php

namespace App\Controller;

use App\Entity\MicroserviceA;
use App\Repository\MicroserviceARepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MicroserviceAController extends AbstractController
{
    /**
     * @Route("/microservice_a", name="microservice_a")
     * @param MicroserviceARepository $repository
     * @return Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function microservice(MicroserviceARepository $repository): Response
    {
        $client = new NativeHttpClient();
        $response = $client->request('GET', 'http://microservice-a/api/information', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $content = json_decode($response->getContent(), true);
        $information = $repository->findAll();
        foreach ($content['hydra:member'] as $item) {
            $microserviceA = new MicroserviceA();
            $microserviceA->setName($item['name']);
            $microserviceA->setGender($item['gender']);
            $microserviceA->setAge($item['age']);
            if(empty($information)){
                $repository->save($microserviceA);
            }
            $info = $repository->findBy(['name' => $microserviceA->getName()]);
            if (empty($info)) {
                $repository->save($microserviceA);
            }
        }
        $information = $repository->findAll();
        return $this->render('microservice_a/microservice.html.twig', [
            'information' => $information
        ]);
    }
}
