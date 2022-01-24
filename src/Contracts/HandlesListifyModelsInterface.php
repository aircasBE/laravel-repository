<?php

namespace Czim\Repository\Contracts;

interface HandlesListifyModelsInterface
{
    /**
     * Updates the position for a record using Listify
     *
     * @param  int $id
     * @param  int $newPosition default: top spot
     * @return bool
     */
    public function updatePosition(int $id, int $newPosition = 1): bool;
}
