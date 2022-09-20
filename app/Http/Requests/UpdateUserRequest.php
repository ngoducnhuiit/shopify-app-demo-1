<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $method = $this->method();
        if($method == 'PUT'){
            return [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required'],
                'purchase_code' => ['required'],
                'url_site' => ['required'],
                'email_verified_at' => ['date_format:Y-m-d H:i:s','nullable'],
            ];
        }else{
            return [
                'name' => ['sometimes','required'],
                'email' => ['sometimes','required', 'email'],
                'password' => ['sometimes','required'],
                'purchase_code' => ['sometimes','required'],
                'url_site' => ['sometimes','required'],
            ];
        }

    }


    protected function prepareForvalidation()
    {
        if($this->purchase_code){
            $this->merge([
                'purchase_code' => $this->purchase_code
            ]);
        }

    }
}
