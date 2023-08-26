<?php

namespace App\Http\Filters\V1;


use App\Http\Filters\ApiFilter;

class CustomerFilter extends ApiFilter
{
    protected array $safeParms = [
        'name' => ['eq'],
        'type' => ['eq','ne'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq','ne'],
        'state' => ['eq','ne'],
        'postalCode' => ['eq','gt','lt'],
    ];

    protected array $columnMap = [
        'postalCode' => 'postal_code'
    ];

    protected array $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];

}
