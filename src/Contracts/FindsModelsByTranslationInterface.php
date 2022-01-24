<?php

namespace Czim\Repository\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface FindsModelsByTranslationInterface
{
    /**
     * Finds a/first model by a given translated property
     *
     * @param  string $attribute must be translated property!
     * @param  string $value
     * @param  string $locale
     * @param  bool   $exact     = or LIKE match
     * @return Model|null
     */
    public function findByTranslation(string $attribute, string $value, ?string $locale = null, bool $exact = true): ?Model;

    /**
     * Finds models by a given translated property
     *
     * @param  string $attribute must be translated property!
     * @param  string $value
     * @param  string $locale
     * @param  bool   $exact     = or LIKE match
     * @return Collection
     */
    public function findAllByTranslation(string $attribute, string $value, ?string $locale = null, bool $exact = true): Collection;
}
