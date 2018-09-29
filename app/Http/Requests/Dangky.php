<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Dangky extends FormRequest
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
            'username'=>'required | unique:users,username',
            'password'=>'required',
            'password2'=>'required',
            'fullname'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'username.required'=>'Vui lòng nhập tài khoản !',
            'username.unique'=>'Tài khoản đã có người sử dụng !',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password2.required'=>'Vui lòng nhập mật khẩu',
            'fullname.required'=>'Vui lòng nhập fullname',
        ];
    }
}
