<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|unique:coupons',
            'code' => 'required|min:3|unique:coupons',
            'quantity' => 'required|numeric|min:1',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount_type' => 'required',
            'discount' => 'required|numeric',
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name field is required',
            'name.min' => 'Name field should have min 3 letters',
            'code.required' => 'Code field is required',
            'code.min' => 'Code field should have min 3 letters',
            'quantity.required' => 'Quantity field is required',
            'quantity.numeric' => 'Quantity must be numeric',
       
            'start_date.required' => 'Start date field is required ',
            'end_date.required' => 'End date field is required ',
            'discount_type.required' => 'Discount type field is required ',
            'discount.required' => 'Discount field is required ',
            'discount.numeric' => 'Discount must be numeric',
            'status.required' => 'Status field is required ',
        ];
    }
}
