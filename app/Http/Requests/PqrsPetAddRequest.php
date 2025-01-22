<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PqrsPetAddRequest extends FormRequest
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
            
				"id_ent" => "required",
				"pet_ent" => "required",
				"pet_tipdoc" => "required",
				"pet_numpet" => "required|numeric",
				"nom_pet" => "required|string",
				"carg_pet" => "required",
				"dir_pet" => "required|string",
				"bar_pet" => "required|string",
				"email_pet" => "required|email|unique:pqrs_pet,email_pet",
				"tele_pet" => "required|string",
				"dpto_pet" => "required",
				"mun_pet" => "required",
				"mun_usu_pet" => "required|string",
				"usuario" => "required|string",
            
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
