<?php

namespace App\Repository;

use App\Entity\MicroserviceB;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MicroserviceB|null find($id, $lockMode = null, $lockVersion = null)
 * @method MicroserviceB|null findOneBy(array $criteria, array $orderBy = null)
 * @method MicroserviceB[]    findAll()
 * @method MicroserviceB[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MicroserviceBRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MicroserviceB::class);
    }

    /**
     * @param MicroserviceB $settings
     * @throws OptimisticLockException
     * @throws ORMException
     */
    final public function save($settings): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($settings);
        $entityManager->flush();
    }
}
