<?php
namespace Czim\Repository\Test\Helpers;

use Illuminate\Support\Collection;
use Czim\Repository\Criteria\NullCriteria;
use Czim\Repository\ExtendedRepository;
use Czim\Repository\Traits\FindsModelsByTranslationTrait;
use Czim\Repository\Traits\HandlesEloquentRelationManipulationTrait;
use Czim\Repository\Traits\HandlesEloquentSavingTrait;
use Czim\Repository\Traits\HandlesListifyModelsTrait;

class TestExtendedRepository extends ExtendedRepository
{
    use HandlesEloquentRelationManipulationTrait;
    use HandlesEloquentSavingTrait;
    use HandlesListifyModelsTrait;
    use FindsModelsByTranslationTrait;

    // model needs an active check by default
    protected bool $hasActive = true;

    // test assumes cache is enabled by default
    protected bool $enableCache = true;

    public function model(): string
    {
        return TestExtendedModel::class;
    }

    public function defaultCriteria(): Collection
    {
        return collect(['TestDefault' => new NullCriteria()]);
    }
}


