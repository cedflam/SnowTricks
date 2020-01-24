<?php

namespace App\Form;

use App\Entity\Tricks;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class FigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label'=> "Nom de la figure"
            ])
            ->add('sentence', TextType::class,[
                'label'=> "Introduction"
            ])
            ->add('contentTricks', TextareaType::class,[
                'label'=> "Description de la figure"
            ])
            ->add('picture', UrlType::class,[
                'label'=> "Photo de présentation",
                'required'=>false,
                'attr'=> [
                    'placeholder'=> " Exemple : https://image.shutterstock.com/image-photo/snowboarder-jumping-through-air-deep-260nw-256525987.jpg"
                ]
            ])
            ->add('idCategory', EntityType::class,[
                'label'=> "Catégorie",
                'class'=> Category::class,
                'choice_label'=> function ($category){
                    return $category->getNameCategory();
                }
            ])
            ->add('images', CollectionType::class,[
                'entry_type'=>ImageType::class,
                'allow_add'=> true,
                'allow_delete'=> true,
               
            ])
            ->add('videos', CollectionType::class,[
                'entry_type'=>VideoType::class,
                'allow_add'=> true,
                'allow_delete'=> true
            ])
            
            ;       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }
}