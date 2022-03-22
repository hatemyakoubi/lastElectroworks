<?php

namespace App\Form;

use App\Entity\Candidat;
use App\Entity\Certificat;
use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CertificatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('specialite',EntityType::class,[
                'class'=> Cours::class,
                'choice_label'=>'Nom',
                 ])
                 ->add('createdAt',DateType::class,[
                    'label'=> 'Certifié le '
                ])
            //->add('Candidat', EntityType::class,[
            //    'class'=>Candidat::class,
            //    'label'=>'candidat',
            //    'choice_label' => 'Nom',
            //])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Certificat::class,
        ]);
    }
}
