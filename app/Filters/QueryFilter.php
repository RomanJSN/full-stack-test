<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     * @return void
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            $method = Str::camel($field);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], (array)$value);
            }
        }
    }

    protected function fields(): array
    {
        $queryParams = $this->request->all();

        $queryParams['limit'] = $queryParams['limit'] ?? 10;
        $queryParams['offset'] = $queryParams['offset'] ?? 0;

        return array_filter(
            array_map('trim', $queryParams)
        );
    }

    protected function limit(int $limit)
    {
        $this->builder->limit($limit);
    }

    protected function offset(int $offset)
    {
        $this->builder->offset($offset);
    }
}
