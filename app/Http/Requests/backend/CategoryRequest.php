<?php
namespace App\Http\Requests\backend;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class CategoryRequest extends FormRequest
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


    public function rules()
    {
        ///MULTI Languages Inputs Validation///////////
        $id                         = $this->request->get('id') ? ',' . $this->request->get('id') : '';
        $rules['title']             = 'required|unique:categories,title'.$id;
        $rules['slug']              = 'required|unique:categories,slug'.$id;
        $rules['description']       = 'nullable|max:500';
        $rules['image']             = 'nullable|max:1000|mimes:jpeg,bmp,png,gif'; // max size 1 MB
        $rules['icon']              = 'nullable|max:100';
        $rules['color']             = 'nullable|max:10';
        $rules['parent_id']         = 'nullable|exists:categories,id';
        return $rules;

    }





    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'   => 'RequestValidation',
            'msg'      => $validator->errors()
        ]));
    }

}
