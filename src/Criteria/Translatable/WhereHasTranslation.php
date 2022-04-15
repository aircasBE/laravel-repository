<?php
namespace Czim\Repository\Criteria\Translatable;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class WhereHasTranslation extends AbstractCriteria
{
    /**
     * If the $exact variable is false ir will look up the translation as an 'LIKE' with the '%' added
     */
    public function __construct(
        protected string $attribute,
        protected string $value,
        protected ?string $locale = null,
        protected bool $exact = true
    ) {
        if (empty($locale)) {
            $locale = app()->getLocale();
        }

        if (! $exact && !preg_match('#^%(.+)%$#', $value)) {
            $value = '%' . $value . '%';
        }

        $this->operator  = $this->exact ? '=' : 'LIKE';
    }


    /**
     * @param $model
     * @return mixed
     */
    protected function applyToQuery($model)
    {
        return $model->whereHas('translations', function (EloquentBuilder $query): Builder {
            return $query->where($this->attribute, $this->operator, $this->value)
                ->where('locale', $this->locale);
        });
    }
}
