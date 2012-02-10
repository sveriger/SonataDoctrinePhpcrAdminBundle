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
        $builder->setAttribute('widget', 'sonata_phpcr_reference');
    }

    public function getParent(array $options)
    {
        return 'field';
    }

    public function getName()
    {
        return 'sonata_phpcr_reference';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'modifiable'    => false,
            'type'          => 'text',
            'type_options'  => array()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function buildViewBottomUp(FormView $view, FormInterface $form)
    {
        $url = '';

        $vars = $view->getVars();
        $value = $vars['value'];

        if ($value instanceof Article) {

            if ($value instanceof \Doctrine\ODM\PHPCR\Proxy\Proxy) {
                $class = get_parent_class($value);
            } else {
                $class = get_class($value);
            }

            $admin = $this->pool->getAdminByClass($class);
            if ($admin) {
                $url = $admin->generateUrl('edit', array('id' => $value->getPath()));
            }
        }

        $view->set('url', $url);
        $view->set('widget', $form->getAttribute('widget'));
    }

}
