<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;


class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank ([
                        'message' => 'veuillez indiquer le nom de votre article.']),
                    new Length ([
                        'max' => 50,
                        'maxMessage' => 'le nom ne peut contenir plus de {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('description', TextareaType::class, [
                'required' => false
            ])


            ->add('price', MoneyType::class, [
                'divisor' => 100,
                'constraints' => [
                    new NotBlank(['message' => 'Le prix est manquant .']),
                    new Positive(['message' => 'Le prix doit etre positif .'])
                ]
            ])
            ->add('category',EntityType::class,[
                //Classe de l'entité  a afficher
                'class'=> Category::class,
                //propriété a afficher dans la lise
                'choice_label'=>'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}


