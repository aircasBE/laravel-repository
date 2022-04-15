<?php

declare(strict_types=1);

namespace Czim\Repository\Traits;

use Czim\Listify\Contracts\ListifyInterface;
use Czim\Repository\Exceptions\RepositoryException;
use InvalidArgumentException;

trait HandlesListifyModelsTrait
{
    /**
     * Updates the position for a record using Listify
     * The default position for the $nowPosition variable is 'top spot'.
     *
     * @throws RepositoryException
     */
    public function updatePosition(int $id, int $newPosition = 1): mixed
    {
        $model = $this->makeModel(false);

        if ( ! ($model = $model->find($id))) {
            return false;
        }

        $this->checkModelHasListify($model);

        /** @var ListifyInterface $model */
        $model->setListPosition($newPosition);

        return $model;
    }

    /**
     * Checks whether the given model has the Listify trait
     *
     * @param $model
     */
    protected function checkModelHasListify($model)
    {
        // should be done with a real interface, but since that is not provided
        // with Listify by default, check only for the methods used here
        // ( ! is_a($model, ListifyInterface::class))

        if (! method_exists($model, 'setListPosition')) {
            throw new InvalidArgumentException('Method can only be used on Models with the Listify trait');
        }
    }
}
