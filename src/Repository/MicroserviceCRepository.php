<?php

namespace App\Repository;

use App\Entity\MicroserviceC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MicroserviceC|null find($id, $lockMode = null, $lockVersion = null)
 * @method MicroserviceC|null findOneBy(array $criteria, array $orderBy = null)
 * @method MicroserviceC[]    findAll()
 * @method MicroserviceC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MicroserviceCRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MicroserviceC::class);
    }

    /**
     * @param MicroserviceC $analytics
     * @throws OptimisticLockException
     * @throws ORMException
     */
    final public function save($analytics): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($analytics);
        $entityManager->flush();
    }
}
