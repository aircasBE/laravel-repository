<?php

namespace Czim\Repository\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HandlesEloquentRelationManipulationInterface
{
    /**
     * Executes a sync on the model provided
     *
     * @param  Model  $model
     * @param  string $relation name of the relation (method name)
     * @param  array  $ids      list of id's to connect to
     * @param  bool    $detaching
     * @return
     */
    public function sync(Model $model, $relation, $ids, $detaching = true);

    /**
     * Executes an attach on the model provided
     *
     * @param  Model   $model
     * @param  string  $relation name of the relation (method name)
     * @param  int     $id
     * @param  array   $attributes
     * @param  bool
     */
    public function attach(Model $model, string $relation, int $id, array $attributes = [], bool $touch = true);

    /**
     * Executes a detach on the model provided
     *
     * @param  Model   $model
     * @param  string  $relation name of the relation (method name)
     * @param  array   $ids
     * @param  boolean $touch
     * @return
     * 
     * @internal param array $attributes
     */
    public function detach(Model $model, string $relation, array $ids = [], bool $touch = true);

    /**
     * Excecutes an associate on the model model provided
     *
     * @param  Model  $model
     * @param  string $relation name of the relation (method name)
     * @param  mixed  $with
     * @return boolean
     */
    public function associate(Model $model, string $relation, mixed $with);

    /**
     * Excecutes a dissociate on the model model provided
     *
     * @param  Model  $model
     * @param  string $relation name of the relation (method name)
     * @param  mixed  $from
     * @return boolean
     */
    public function dissociate(Model $model, string $relation, mixed $from);
}
