<?php

namespace App\Controller;


use App\Form\UserProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account/profile", name="account_profile")
     * autoriser l'acces uniquement aux utilisateurs connectes isgranted()
     * @IsGranted("ROLE_USER")
     */
                                                  // pour la modification de l'email
    public function updateProfile(Request $request, EntityManagerInterface $entityManager)
    {//Recuperer l'utilisateur actuel:$this->getUser()

        $form = $this->createForm(UserProfileFormType::class,$this->getUser());

        //recuperrer la requet get post
        $form->handleRequest($request);
        //verifier si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {
        //il n'est pas necessair d'appeler persist() pour modifier des entites
            $entityManager->Flush();
            $this->addFlash('success','votre profil a été mis a jour ');

        }



        return $this->render('account/profile.html.twig', [
            'updateProfileForm' => $form->createView()

        ]);
    }
}
