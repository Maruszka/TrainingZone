<?php

namespace TrainingZoneBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TrainingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', "text", ['label'=>"Name: "])
            ->add('description',"text", ['label'=>"Description: "])
            ->add('date',"date", ['label'=>"Date of the training: "])
            ->add('max',"integer", ['label'=>"Max number of participants: "])
            ->add('min',"integer", ['label'=>"Max number of participants: "])
            ->add('place',"text", ['label'=>"Where is the training: "])
            ->add('status',"entity", ["class" => "TrainingZoneBundle:Status", "choice_label" => "type", "expanded" => false, "multiple" => false])
            ->add('categories',"entity", ["class" => "TrainingZoneBundle:Category", "choice_label" => "name", "expanded" => false, "multiple" => true])
            ->add('users', "entity", ["class" => "TrainingZoneBundle:Category", "choice_label" => "name", "expanded" => false])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TrainingZoneBundle\Entity\Training'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'trainingzonebundle_training';
    }
}
