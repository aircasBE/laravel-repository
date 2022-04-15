<?php

namespace Czim\Repository\Criteria\Common;

use Czim\Repository\Criteria\AbstractCriteria;

/**
 * Applies a SINGLE scope
 */
class Scope extends AbstractCriteria
{
    public function __construct(
        protected string $scope,
        protected array $parameters = []
    ) {
    }

    /**
     * @param $model
     * @return mixed
     */
    protected function applyToQuery($model)
    {
        return call_user_func_array([$model, $this->scope], $this->parameters);
    }
}
