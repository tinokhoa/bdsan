<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UsersFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|min:5|max:100|confirmed',
        ];
    }
    
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập vào họ tên',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự',
            'email.required'  => 'Vui lòng nhập vào email',
            'email.max'  => 'Email không được vượt quá 255 ký tự',
            'password.required'  => 'Vui lòng nhập vào mật khẩu',
            'password.confirmed'  => 'Nhập lại mật khẩu không chính xác',
            'password.min'  => 'Mật khẩu phải có ít nhất 5 ký tự',
            'password.max'  => 'Mật khẩu không được vượt quá 100 ký tự',
        ];
    }
}
