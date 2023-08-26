<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\V1\BulkStore;
use App\Http\Requests\Customer\V1\StoreRequest;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new \App\Http\Filters\V1\InvoiceFilter();
        $queryParams = $filter->transform($request);

        $customer = Invoice::where($queryParams);

        return InvoiceResource::collection($customer->paginate(10)->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //
    }

    public function bulkStore(BulkStore $request): void
    {

        $bulk = collect($request->all())->map(function ($arr,$key) {
            return Arr::except($arr,['customerId','billedDate','paidDate']);
        })->toArray();


        Invoice::insert($bulk);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
