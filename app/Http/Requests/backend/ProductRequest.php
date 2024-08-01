<?php
namespace App\Http\Requests\backend;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
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


    public function rules()
    {
        ///MULTI Languages Inputs Validation///////////
        $id                         = $this->request->get('id') ? ',' . $this->request->get('id') : '';
        $rules['title']             = 'required|unique:products,title'.$id;
        $rules['slug']              = 'required|unique:products,slug'.$id;
        $rules['description']       = 'nullable';
        $rules['brief']             = 'nullable';
        $rules['brand_id']          = 'nullable|exists:brands,id';
        $rules['category_id']       = 'nullable|exists:categories,id';
        $rules['sub_category_id']   = 'nullable|exists:categories,id';
        $rules['image']             = 'nullable|max:1000|mimes:jpeg,bmp,png,gif'; // max size 1 MB
        $rules['gallery.*']         = 'nullable|max:1000|mimes:jpeg,bmp,png,gif'; // max size 1 MB

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
