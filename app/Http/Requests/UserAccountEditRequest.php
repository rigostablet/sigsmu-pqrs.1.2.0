<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAccountEditRequest extends FormRequest
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
            
				"username" => "filled|string",
				"phone" => "filled|string",
				"photo" => "filled",
				"fullname" => "filled|string",
				"role" => "filled|string",
				"mun" => "nullable|string",
				"photo_mun" => "nullable",
				"user_role_id" => "nullable",
				"email_verified_at" => "nullable|date",
				"account_status" => "nullable|string",
				"cod_mun" => "nullable|string",
				"dpto_user" => "nullable|string",
				"oficina" => "filled|string",
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
