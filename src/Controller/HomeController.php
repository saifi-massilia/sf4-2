<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $repositoryProd, CategoryRepository $repositoryCat)
    {// findBy() va effectuer une comparaison d'égalité, alors que nous souhaitons effectuer une comparaison de supériorité
        // solution: créer notre propre méthode dans le ProductRepository
        //$repository->findBy([
        // 'createdAt' => new \DateTime('-1 month')


        //********************************* la solution**************************************************
        //on utilise notre propre methode pour recuperer les nouveautés
        $result = $repositoryProd->findNews();
        $categories = $repositoryCat->findAll();

        return $this->render('home/index.html.twig', [
            'new_products' =>$result,
            'categories'=>$categories,
        ]);

    }

//       /**
    //     * @Route("/{id}", name="productByCategory")
    //     */
//    public function productByCategory (Request $request, ProductRepository $repositoryProd, CategoryRepository $repositoryCat)
//    {
//        $id=$request->query->get('id');
//        //$result = $repositoryProd->findByCategory($id);
//        $result = $repositoryProd->findBy( array('category'=> $id));
//        $category = $repositoryCat->findAll();
//
//
//        return $this->render('home/index.html.twig', [
//
//
//            'new_products' =>$result,
//            'category_list'=>$category,
//        ]);

    //}
}
