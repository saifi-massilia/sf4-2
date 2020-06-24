<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /*
     * Recuperer les nouveaux produits : produits crees il y a moins d'un mois

      */
    /**
     * recuperer les nv produits : produits crees il y a moins d'un mois
     * retourne un tab d'objets product
     * @return Product[]
     */
    public function findNews()
    {
        //Creation d'un queryBuilder(constructeur de requete)
        return $this->createQueryBuilder('p')                 #'p' =alias de Product
        ->where('p.createdAt >=:last_month')
            ->setParameter('last_month', new \DateTime('-1 month'))
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()                                              #obtenir la requete
            ->getResult();                                #"obtenir un tableau d'entités "
    }

    /*
             SELECT  t0.id, t0.name, ...
             FROM product t0
             WHERE t0.created_at >= :last_month
             ORDER BY t0.created_at
          */
    /* */

    /**
     * ici commentaires
     * @routes  ici cest la route
     */

}
