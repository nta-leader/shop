<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
class addCat extends FormRequest
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
    public function rules(Request $req)
    {
        $parent_id=$req->parent_id;
        return [
            'parent_id'=>'required',
            'namecat'=>'required',
            /*'namecat'=>
                        Rule::unique('cat')->where(function ($query) {
                            $query->where('parent_id',$parent_id);
                        })*/
        ];
    }
    public function messages()
    {
        return [
            'parent_id.required'=>'Vui lòng chọn danh mục cha !',
            'namecat.required'=>'Tên danh mục không được để rỗng !',
            /*'namecat.unique'=>'danh muc trung !'*/
        ];
    }
}
