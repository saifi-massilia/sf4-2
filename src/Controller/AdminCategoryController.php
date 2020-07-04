<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Form\ConfirmDeletionFormType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**

 * @route("/admin/category", name="admin_category_")
 */
class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/list", name="list")
     */
    public function list(CategoryRepository $repository)
    {
        $category = $repository->findAll();
        return $this->render('admin_category/list.html.twig', [
            'category_list' => $category,
        ]);
    }

    /**
     *
     * @param Request $request : requette http.
     * @param EntityManagerInterface $entityManager : entity manager acces a la bdd
     * @Route ("/add", name="add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(CategoryFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $category = $form->getData();
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'la catégorie ' . $category->getName() . ' a été crée');
            return $this->redirectToRoute('admin_category_list');
        }
        return $this->render('admin_category/add.html.twig', [
            'category_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit")
     */
    public function edit(Category $category, Request $request, EntityManagerInterface $entityManager)
    {

        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager->flush();
            $this->addFlash('success', 'la catégorie ' . $category->getName() . ' a été modifiée');
            return $this->redirectToRoute('admin_category_edit',array('id' => $category->getId()));

        }

        return $this->render('admin_category/edit.html.twig', [
            'category' => $category,
            'category_form' => $form->createView()
        ]);

    }

    /**
     * @Route("/{id}/delete", name="delete")
     */
    public function delete (Category $category ,Request $request ,EntityManagerInterface $entityManager)
    {
        $form=$this->createForm(ConfirmDeletionFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $entityManager->remove($category);
            $entityManager->flush();

            $this->addFlash('success','La catégorie  '.$category->getName().' a été supprimée');
            return $this->redirectToRoute('admin_category_list');
        }
        return $this->render('admin_category/delete.html.twig',[
            'category'=>$category,
            'deletion_form'=>$form->createView()
        ]);
    }






























}
