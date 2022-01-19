<?php

namespace App\Http\Requests\Backend;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'email' => 'required|unique:users',
                        'name' => 'required',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {

                    //dd($this->route()->user);
                    return [
                        'email' => 'required|unique:users,email,'.$this->id,
                        'name' => 'required|min:2',
                    ];
                }
            default: break;
        }


    }
}
