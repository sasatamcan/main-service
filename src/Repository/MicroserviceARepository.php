<?php

namespace App\Repository;

use App\Entity\MicroserviceA;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MicroserviceA|null find($id, $lockMode = null, $lockVersion = null)
 * @method MicroserviceA|null findOneBy(array $criteria, array $orderBy = null)
 * @method MicroserviceA[]    findAll()
 * @method MicroserviceA[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MicroserviceARepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MicroserviceA::class);
    }

    /**
     * @param MicroserviceA $info
     * @throws ORMException
     * @throws OptimisticLockException
     */
    final public function save($info): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($info);
        $entityManager->flush();
    }
}
