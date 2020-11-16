<?php

namespace App\Controller;

use App\Entity\MicroserviceB;
use App\Repository\MicroserviceBRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class MicroserviceBController extends AbstractController
{
    /**
     * @Route("/microservice_b", name="microservice_b")
     * @param MicroserviceBRepository $repository
     * @return Response
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function microservice(MicroserviceBRepository $repository): Response
    {
        $client = new NativeHttpClient();
        $response = $client->request('GET', 'http://microservice-b/read/security_settings', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $content = json_decode($response->getContent(), true);
        $settings = $repository->findAll();
        foreach ($content as $item){
           $microserviceB = new MicroserviceB();
           $microserviceB->setEmail($item['email']);
           $microserviceB->setCode($item['code']);
           $microserviceB->setNotification($item['notification']);
           $microserviceB->setPayments($item['payments']);
           if(empty($settings)){
               $repository->save($microserviceB);
           }
           $setting = $repository->findBy(['email'=>$microserviceB->getEmail()]);
           if(empty($setting)){
               $repository->save($microserviceB);
           }
       }
        $settings = $repository->findAll();
        return $this->render('microservice_b/microservice.html.twig', [
            'settings' => $settings
        ]);
    }
}
