<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|min:10|unique:users',
            'password' => 'required|regex:/^([0-9])*$/',
            'phone' => 'required|min:9|max:12|regex:/([0-9 ])+/|unique:users',
            'userName' => 'required|min:3|max:100',
            'birthday' => 'required',
        ];
    }


    
    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'email.min' => 'Email không đúng định dạng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.regex' => 'Sai định dạng mật khẩu',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.regex' => 'Số điện thoại phải chứa ký tự số và chứa từ 9 đến 12 ký tự',
            'phone.min' => 'Số điện thoại phải chứa ký tự số và chứa từ 9 đến 12 ký tự',
            'phone.max' => 'Số điện thoại phải chứa ký tự số và chứa từ 9 đến 12 ký tự',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'userName.required' => 'Vui lòng nhập đầy đủ họ tên',
            'userName.min' => 'Tên từ 3 đến 100 ký tự',
            'userName.max' => 'Tên từ 3 đến 100 ký tự',
            'birthday.required' => 'Vui lòng nhập ngày sinh',
        ];
    }
}
