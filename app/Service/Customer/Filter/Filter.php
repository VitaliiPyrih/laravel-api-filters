<?php

declare(strict_types=1);

namespace App\Service\Customer\Filter;

use App\Http\Filters\V1\CustomerFilter;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;

class Filter
{
    public static function index($request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $filter = new CustomerFilter();
        $queryParams = $filter->transform($request);

        $includeInvoice = $request->query('includeInvoices');

        $customer = Customer::where($queryParams);

        if($includeInvoice) {
            $customer = $customer->with('invoices');
        }

        return CustomerResource::collection($customer->paginate(10)->appends($request->query()));
    }
}
