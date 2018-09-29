<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addNews extends FormRequest
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
            'name'=>'required | unique:news,namenew',
            'hinhanh'=>'required',
            'gioithieu'=>'required',
            'chitiet'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Vui lòng nhập tên bài viết !',
            'name.unique'=>'Tên bài viết đã tồn tại !',
            'hinhanh.required'=>'Vui lòng chọn hình ảnh !',
            'gioithieu.required'=>'Vui lòng nhập giới thiệu !',
            'chitiet.required'=>'Vui lòng nhập chi tiết !'
        ];
    }
}

