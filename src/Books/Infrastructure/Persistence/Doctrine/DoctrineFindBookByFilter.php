<?php

namespace App\Books\Infrastructure\Persistence\Doctrine;

use App\Books\Domain\BookFilter;
use Doctrine\ORM\QueryBuilder;

class DoctrineFindBookByFilter
{
    public static function filter(QueryBuilder $qb, BookFilter $filter): QueryBuilder
    {
        $title = $filter->title()->getValue();
        $score = $filter->score()->getValue();

        if ($title != null) {
            $qb->where('book.title.value LIKE :title')
                ->setParameter('title', '%' . $title . '%');
        }

        if ($score != null) {
            $qb->andWhere('book.score.value = :score')
                ->setParameter('score', $score);
        }

        $qb->setFirstResult($filter->offset());
        $qb->setMaxResults($filter->limit());
        return $qb;
    }
}
