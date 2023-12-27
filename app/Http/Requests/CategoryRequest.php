<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
    {  $rules = [];

        // Lấy phương thức đang hoạt động
        $currentAction = $this->route()->getActionMethod();

        switch ($this->method()) {
            case 'POST':
                switch ($currentAction) {
                    case 'store':
                        $rules = [
                            'category_name' => 'required|unique:categories|max:255',
                            'note'=> 'nullable',
                            'image' => ['nullable', 'image'],
                            'status' => 'required|in:active,inactive',
                        ];
                        break;
                        case 'edit':
                            $id = $this->route('id');
                            $rules = [
                                'category_name' => [
                                    'required',
                                    Rule::unique('categories')->ignore($id),
                                    'max:255',
                                ],
                                'note' => 'nullable',
                                'image' => ['nullable', 'image'],
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
    public function messages(): array
{
    return [
        'category_name.required' => 'Trường tên danh mục là bắt buộc.',
        'category_name.unique' => 'Tên danh mục đã tồn tại.',
        'category_name.max' => 'Tên danh mục không được vượt quá :max ký tự.',
        'image.image' => 'Trường hình ảnh phải là một hình ảnh.',
        'status.required' => 'Trường trạng thái là bắt buộc.',
        'status.in' => 'Trường trạng thái không hợp lệ.',
    ];
}

}

