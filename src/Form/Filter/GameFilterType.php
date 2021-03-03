<?php


namespace App\Form\Filter;


use App\Entity\Genres;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Lexik\Bundle\FormFilterBundle\Filter\FilterBuilderExecuterInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\EntityFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\SharedableFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Form\Type\TextFilterType;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class GameFilterType.php
 *
 * @author Kevin Tourret
 */
class GameFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextFilterType::class, [
                'condition_pattern' => FilterOperands::STRING_CONTAINS,
                'attr' => [
                    'placeholder' => 'Nom de jeu',
                ],
            ])
            // En ManyToOne
//            ->add('genres', EntityFilterType::class, [
//                'label' => false,
//                'class' => Genres::class,
//                'choice_label' => 'name',
//            ])
//            ->add('genres', EntityFilterType::class, [
//                'label' => false,
//                'class' => Genres::class,
//                'choice_label' => 'name',
//                'apply_filter' => function(QueryInterface $filterQuery, $field, $values) {
//                    if (empty($values['value'])) {
//                        return null;
//                    }
//                    $expr = $filterQuery->getExpr();
//                    $paramName = sprintf('p_%s', str_replace('.', '_', $field));
//                    return $filterQuery->createCondition(
//                        $expr->eq($field, ':'.$paramName),    // expression
//                        array($paramName => $values['value']) // parameters [ name => value ]
//                    );
//                },
//            ])
            ->add('genres', GenreFilterType::class, [
                'label' => false,
                'add_shared' => function (FilterBuilderExecuterInterface $qbe) {
                    $closure = function (QueryBuilder $filterBuilder, $alias, $joinAlias, Expr $expr) {
                        $filterBuilder->leftJoin($alias . '.genres', $joinAlias);
                    };
                    $qbe->addOnce($qbe->getAlias().'.genres', 'genre', $closure);
                }
            ])
        ;
    }
}
