<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product_list")
     */
    public function list(ProductRepository $repository)
    {
        //recuperation de tout les produits
        $product_list = $repository->findall();
        return $this->render('product/list.html.twig', [
            'all_products' => $product_list,
        ]);
    }




    /**
     * grace au paramConverter (installé par framwork extrabundl)
     * symfony va recuperer l'entité product qui correspond a l'indentifiant dans l'uri
     * @Route("/product/{id}", name="product_show")
     */
    public function show(Product $product)
    {

        return $this->render('product/show.html.twig', [
          'product'=>$product
        ]);
    }


    /**
     * grace au paramConverter (installé par framwork extrabundl)
     * symfony va recuperer l'entité product qui correspond a l'indentifiant dans l'uri
     * @Route("/productByCategory/{id}", name="product_by_category")
     */
    public function productByCategory(Category $category,  CategoryRepository $repositoryCat)
    {
        $categories = $repositoryCat->findAll();
        return $this->render('product/product_by_category.html.twig', [
            'category'=>$category,
            'categories'=>$categories,
        ]);
    }

//    /**
//     * @Route("/product", name="product_list")
//     */
//    public function list(ProductRepository $repository)
//    {
//        //recuperation de tout les produits
//        $product_list = $repository->findall();
//        return $this->render('product/list.html.twig', [
//            'all_products' => $product_list,
//        ]);
//    }


}
