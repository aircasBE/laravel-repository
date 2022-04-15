<?php

namespace Czim\Repository\Criteria\Common;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;

class FieldIsValue extends AbstractCriteria
{
    public function __construct(
        protected string $field,    // The field ti where for.
        protected mixed $value,     // The value to check for.
    ) {
    }

    /**
     * @param Builder $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        return $model->where($this->field, $this->value);
    }
}
