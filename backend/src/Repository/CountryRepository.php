<?php

namespace App\Repository;

use App\Entity\Country;
use App\Entity\CountryCases;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    public function findCountryNames()
    {
        return $this->_em->createQueryBuilder()
            ->select('c.id, c.name')
            ->from(Country::class, 'c')
            ->orderBy('c.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getCountriesAmount()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb
            ->select('count(c.id) as amount')
            ->from(Country::class, 'c')
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getCountriesFromPath(array $path)
    {
        return $this->_em->createQueryBuilder()
            ->select('c')
            ->from(Country::class, 'c')
            ->where('c.id IN (:path)')
            ->setParameter('path', $path)
            ->getQuery()
            ->getResult()
        ;
    }
}