<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class EleveType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('matricule', TextType::class, array('label' => 'Matricule:', 'required' => true, 'attr' => array('class' => 'form-control')))
            ->add('matricule', TextType::class, array('label' => 'Matricule:', 'required' => true, 'attr' => array('class' => 'form-control')))
            ->add('nom', TextType::class, array('label' => 'Nom de l\'élève:', 'required' => true, 'attr' => array('class' => 'form-control')))
            ->add('prenom',TextType::class, array('label' => 'Prénom(s) de l\'élève:', 'required' => true, 'attr' => array('class' => 'form-control')))
            //->add('datenaiss', TextType::class, array('label' => 'Date de naissance:', 'required' => true, 'attr' => array('class' => 'form-control')))
            ->add('lieunaiss', TextType::class, array('label' => 'Lieu de naissance:', 'required' => true, 'attr' => array('class' => 'form-control')))
            ->add('sexe', ChoiceType::class, array('label' => 'Sexe:', 'required' => true,
                'choices' => array('Choisir une valeur' => '','Maculin' => 'M', 'Féminin' => 'F'), 'attr' => array('class' => 'form-control')));

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Eleve'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_eleve';
    }


}
