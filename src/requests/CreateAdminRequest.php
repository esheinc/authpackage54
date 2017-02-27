<?php

namespace Esheinc\AuthPackage\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateAdminRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id' => 'required',
            'level' => 'required',
            'status' => 'required',
            'username' => 'required|min:4',
            'password' => 'required|min:6|confirmed',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admins',
            'last_login_at' => 'required',
            'last_login_ip' => 'required',
            'last_login_geo' => 'required',
        ];
    }
}
