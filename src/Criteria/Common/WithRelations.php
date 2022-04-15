<?php

namespace Czim\Repository\Criteria\Common;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Eloquent\Builder;

class WithRelations extends AbstractCriteria
{
    public function __construct(
        protected array $withStatements = []
    ) {
    }

    /**
     * @param Builder $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        return $model->with($this->withStatements);
    }
}
