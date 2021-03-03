<?php


namespace App\Form\Filter;


use App\Entity\Genres;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\SharedableFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\TextFilterType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class GenreFilterType.php
 *
 * @author Kevin Tourret
 */
class GenreFilterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextFilterType::class, [
                'label' => false,
                'condition_pattern' => FilterOperands::STRING_CONTAINS,
            ])
        ;
    }

    /**
     * @return string
     */
    public function getParent(): string
    {
        return SharedableFilterType::class;
    }
}
