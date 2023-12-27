<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class   ProductRequest extends FormRequest
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
    public function messages(): array
{
    return [
        'name.required' => 'Trường tên sản phẩm là bắt buộc.',
        'name.unique' => 'Tên sản phẩm đã tồn tại.',
        'name.max' => 'Tên sản phẩm không được vượt quá :max ký tự.',
        'price.required' => 'Trường giá sản phẩm là bắt buộc.',
        'price.min' => 'Trường giá sản phẩm không được nhỏ hơn :min.',
        'image.required' => 'Trường hình ảnh là bắt buộc.',
        'image.image' => 'Trường hình ảnh phải là một hình ảnh.',
        'description.required' => 'Trường mô tả là bắt buộc.',
        'description.string' => 'Trường mô tả phải là một chuỗi.',
        'category_id.required' => 'Trường danh mục là bắt buộc.',
        'status.required' => 'Trường trạng thái là bắt buộc.',
        'status.in' => 'Trường trạng thái không hợp lệ.',
    ];
}
    public function rules(): array
    {
        $rules = [];

        // Lấy phương thức đang hoạt động
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'add':
                        $rules = [
                            'name' => 'required|unique:products|max:255',
                            'price' => 'required|min:0',
                            'image' => ['required', 'image'],
                            'description' => 'required|string',
                            'category_id' => 'required|integer',
                            'status' => 'required|in:active,inactive',
                        ];
                        break;
                    case 'edit':
                        $id = $this->route('id');
                        $rules = [
                            'name' => [
                                'required',
                                Rule::unique('products')->ignore($id),
                                'max:255',
                            ],
                            'price' => 'required|min:0',
                            'image' => 'image',
                            'description' => 'required|string',
                            'category_id' => 'required|integer',
                            'status' => 'required|in:active,inactive',
                        ];
                        break;
                    default:
                        break;
                }
                break;
        }

        return $rules;
    }
}
