<?php

namespace Czim\Repository\Criteria\Common;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

class IsActive extends AbstractCriteria
{
    /**
     * The column name to check for 'active' state
     */
    public function __construct(
        protected string $column = 'active'
    ) {
    }

    /**
     * @param Builder $model
     * @return mixed
     */
    public function applyToQuery($model): mixed
    {
        return $model->where($this->column, true);
    }
}
