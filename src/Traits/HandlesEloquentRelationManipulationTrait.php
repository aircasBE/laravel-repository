<?php

declare(strict_types=1);

namespace Czim\Repository\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * The point of this is to provide Eloquent relations management through
 * some intermediate object (i.e. a Repository) to make model manipulation
 * easier to test/mock.
 */
trait HandlesEloquentRelationManipulationTrait
{
    /**
     * Executes a sync on the model provided
     */
    public function sync(Model $model, string $relation, array $identifiers, bool $detaching = true): array
    {
        return $model->{$relation}()->sync($identifiers, $detaching);
    }

    /**
     * Executes an attachment on the model provided
     *
     * @param  Model    $model
     * @param  string   $relation       name of the relation (method name)
     * @param  int      $id
     * @param  array    $attributes
     * @param  bool     $touch
     */
    public function attach(Model $model, string $relation, int $id, array $attributes = [], bool $touch = true)
    {
        return $model->{$relation}()->attach($id, $attributes, $touch);
    }

    /**
     * Executes a detach on the model provided
     *
     * @param  Model    $model
     * @param  string   $relation name of the relation (method name)
     * @param  array    $ids
     * @param  bool     $touch
     * @return
     * @internal param array $attributes
     */
    public function detach(Model $model, $relation, $ids = array(), $touch = true)
    {
        return $model->{$relation}()->detach($ids, $touch);
    }

    /**
     * Execution method for associating the model instance to its given parent.
     */
    public function associate(Model $model, string $relation, mixed $with): bool
    {
        return $model->{$relation}()->associate($with);
    }

    /**
     * Executes a dissociated on the model provided
     */
    public function dissociate(Model $model, string $relation, mixed $from): bool
    {
        return $model->{$relation}()->dissociate($from);
    }
}
