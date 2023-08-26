<?php

namespace App\Http\Requests\Customer\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BulkStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            '*.customerId' => 'required|integer',
            '*.amount' => 'required|numeric',
            '*.status' => [Rule::in(['B','V','P','b','v','p']),'required'],
            '*.billedDate' => 'required|date_format:Y-m-d H:i:s',
            '*.paidDate' => 'date_format:Y-m-d H:i:s|nullable',
        ];
    }
    protected function prepareForValidation(): void
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['customer_id'] = $obj['customerId'] ?? null;
            $obj['build_date'] = $obj['billedDate'] ?? null;
            $obj['paid_date'] = $obj['paidDate'] ?? null;


            $data[] = $obj;
        }
        $this->merge($data);
    }
}
