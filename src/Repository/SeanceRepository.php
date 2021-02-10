<?php

namespace App\Repository;

use App\Entity\Film;
use App\Entity\Seance;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Seance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seance[]    findAll()
 * @method Seance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seance::class);
    }

    public function get3NextSeance(Film $film, int $limit)
    {
        $date = new DateTime();
        
        return $this->createQueryBuilder('s')
                ->andWhere('s.film = :film')
                ->setParameter('film', $film)
                ->andWhere('s.dateSeance >= :date')
                ->setParameter('date', $date)
                ->orderBy('s.dateSeance', 'ASC')
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult()
            ;           
    }
}
