<?php


namespace App\Http\Filters\V1;

use App\Http\Filters\ApiFilter;

class InvoiceFilter extends ApiFilter
{
    protected array $safeParms = [
        'customerId' => ['eq'],
        'amount' => ['eq','lt','gt','lte','gte'],
        'status' => ['eq','ne'],
        'buildDate' => ['eq','lt','gt','lte','gte'],
        'paidDate' => ['eq','lt','gt','lte','gte'],
    ];

    protected array $columnMap = [
        'customerId' => 'customer_id',
        'buildDate' => 'build_date',
        'paidDate' => 'paid_date'
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
