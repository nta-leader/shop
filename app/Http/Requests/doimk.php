<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class doimk extends FormRequest
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
            'password'=>'required | min:3',
            'password2'=>'required | min:3',
            'password3'=>'required | min:3',
        ];
    }
    public function messages()
    {
        return [
            'password.required'=>'Vui lòng nhập mật khẩu !',
            'password.min'=>'Mật khẩu tối thiểu 3 ký tự !',
            'password2.required'=>'Vui lòng nhập mật khẩu mới !',
            'password2.min'=>'Mật khẩu tối thiểu 3 ký tự !',
            'password3.required'=>'Vui lòng nhập lại mật khẩu mới !',
            'password3.min'=>'Mật khẩu tối thiểu 3 ký tự !',
        ];
    }
}
