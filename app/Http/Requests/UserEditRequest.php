<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
		
		$rec_id = request()->route('rec_id');

        return [
            
				"username" => "filled|string|unique:user,username,$rec_id,iduser",
				"phone" => "filled|string",
				"photo" => "filled",
				"fullname" => "filled|string",
				"role" => "filled",
				"oficina" => "filled",
				"dpto_user" => "nullable",
				"cod_mun" => "nullable",
				"mun" => "nullable|string",
				"photo_mun" => "nullable",
				"user_role_id" => "nullable",
				"email_verified_at" => "nullable|date",
				"account_status" => "nullable|string",
				"nom_ofic_user" => "filled|string",
            
        ];
    }

	public function messages()
    {
        return [
			
            //using laravel default validation messages
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            //eg = 'name' => 'trim|capitalize|escape'
        ];
    }
}
