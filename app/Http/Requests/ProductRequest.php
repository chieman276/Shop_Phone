<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'productName' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'productName.required' => 'Vui lòng nhập tên sản phẩm',
            'description.required' => 'Vui lòng nhập chi tiết sản phẩm',
            'image.required' => 'Vui lòng nhập ảnh sản phẩm',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
        ];
    }
}
