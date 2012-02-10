<?php

namespace Sonata\DoctrinePHPCRAdminBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType as FormChoiceType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\Translation\TranslatorInterface;


class ReferenceType extends AbstractType
{

    protected $pool;

    public function __construct($pool)
    {
        $this->pool = $pool;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->setAttributes('widget', 'sonata_phpcr_reference');
    {

    public function getParent(array $options)
    {
        return 'field';
    }

    public function getName()
    {
        return 'sonata_phpcr_reference';
    }
}
