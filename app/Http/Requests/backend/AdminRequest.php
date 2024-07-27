<?php
namespace App\Http\Requests\backend;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class AdminRequest extends FormRequest
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
        $id = $this->request->get('id') ? ',' . $this->request->get('id') : '';
        $rules['name']      = 'required|string|max:255'.$id;

        $rules['email']     = 'required|string|max:255|email|unique:admins,email'.$id;
        $rules['roles']     = 'required|exists:roles,name';

        $rules['mobile']    = 'required|max:255|unique:admins,mobile'.$id;
        $rules['avatar']    = 'nullable|max:1000|mimes:jpeg,bmp,png,gif'; // max size 1 MB


        $rules['is_active'] = 'nullable|in:0,1';


        $rules['username']  = 'required|string|max:255|unique:admins,username'.$id;
        if(!isset($id)){
            $rules['password']  = 'required|string|min:8|confirmed';
        }


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
