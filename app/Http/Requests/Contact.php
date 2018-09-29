<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Contact extends FormRequest
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
            'name'=> 'required',
            'email'=> 'required | email',
            'phone' => 'required',
            'message'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Bạn chưa nhập họ tên !',
            'email.required'=>'Bạn chưa nhập email !',
            'email.email'=>'Nhập đúng định dạng email !',
            'phone.required'=>'Bạn chưa nhập số điện thoại !',
            'message.required'=>'Bạn chưa nhập tin nhắn !'
        ];
    }
}
