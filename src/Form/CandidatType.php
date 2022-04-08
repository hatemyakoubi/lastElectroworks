<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\Candidat;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                'label'=>'Nom'
            ])
            ->add('prenom', TextType::class,[
                'label'=>'Prénom'
            ])
            ->add('cin')
            ->add('date_naissance',BirthdayType::class,[
                'label'=>'Né le'
                
            ])
            ->add('lieu_naissance', TextType::class,[
                'label'=>'À'
            ])
            ->add('niveau_etude', ChoiceType::class,[
                'label'=>'Niveau d\'études',
                'placeholder'=>'Sélectionnez un niveau',
                'choices'=>[
                    'Ignorant'=>'Ignorant',
                    'Primaire'=>'Primaire',
                    'Sécondaire'=>'Sécondaire',
                    'Universitaire'=>'Universitaire',
                    'Proffesionnel'=>'Proffesionnel',
                    'BTP'=>'BTP',
                    'BTS'=>'BTS',
                    'CAP'=>'CAP',
                ]
            ])
            ->add('specialite', TextType::class,[
                'label'=>'Spécialité'
            ])
            ->add('etablissement', TextType::class,[
                'label'=>'Etablissement'
            ])
            ->add('telephone',TextType::class,[
                'label'=> 'Télèphone',
            ])
            ->add('createdAt',DateType::class,[
                'label'=> 'Date d\'inscription '
            ])
            ->add('dure_formation', TextType::class,[
                'label'=>'Dureé de la formation'
            ])
            ->add('coursFavorie',ChoiceType::class,[
                'label'=>'Cours',
                //'multiple'=>true,
                'required'=>true,
                'expanded'=>true,
                'choices'=>[
                    'Matinal'=>'Matinal',
                    'Soir'=>'Soir',
                    'Week-end'=>'Week-end'
                ],

            ])
            ->add('besoin',ChoiceType::class,[
                'label'=> 'Besoin',
                'placeholder'=>'Sélectionnez un besoin',
                'choices'=>[
                    'A1'=>'A1',
                    'A2'=>'A2',
                    'A1,A2'=>'A1,A2',
                    'B1'=>'B1',
                    'B2'=>'B2',
                    'B1,B2'=>'B1,B2',
                    'Améliorer mon CV/Compétences'=>'Améliorer mon CV/Compétences',
                    'Travail'=>'Travail',
                    'Voyage/Migration'=>'Voyage/Migration'
                ]
            ])
            ->add('formation',EntityType::class,[
                'class'=>Cours::class,
                'label'=>'Formation',
                'choice_label' => 'Nom',
                'multiple'=>true,
                //'by_reference'=> false,
                'attr'=>[
                    'class'=> 'selectFormation',
                 ]
                
                

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
