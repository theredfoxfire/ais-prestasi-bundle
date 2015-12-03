<?php

namespace Ais\PrestasiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrestasiType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mahasiswa_id')
            ->add('semester_id')
            ->add('e_sks_lulus')
            ->add('e_sks_diambil')
            ->add('e_sks_lulus_x_na')
            ->add('e_sks_diambil_x_na')
            ->add('ipk')
            ->add('ips')
            ->add('ipsk')
            ->add('is_active')
            ->add('is_delete')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ais\PrestasiBundle\Entity\Prestasi',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
