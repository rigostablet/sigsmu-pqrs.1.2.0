<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PqrsPetEditRequest extends FormRequest
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
            
				"id_ent" => "filled",
				"pet_ent" => "filled",
				"pet_tipdoc" => "filled",
				"pet_numpet" => "filled|numeric",
				"nom_pet" => "filled|string",
				"carg_pet" => "filled",
				"dir_pet" => "filled|string",
				"bar_pet" => "filled|string",
				"email_pet" => "filled|email|unique:pqrs_pet,email_pet,$rec_id,id_pet",
				"tele_pet" => "filled|string",
				"dpto_pet" => "filled",
				"mun_pet" => "filled",
				"mun_usu_pet" => "filled|string",
				"usuario" => "filled|string",
            
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
