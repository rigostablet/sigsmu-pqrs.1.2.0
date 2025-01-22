<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PqrsRegPqrsEditRequest extends FormRequest
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
            
				"fec_sol" => "nullable|date",
				"fecrep_sol" => "nullable|date",
				"tip_ent_sol" => "filled",
				"id_ent_sol" => "filled",
				"id_pet" => "filled",
				"tip_sol" => "filled",
				"medio_sol" => "filled",
				"desc_sol" => "filled",
				"regsol_photo" => "filled",
				"regsol_dias" => "filled",
				"diaspen_sol" => "nullable|numeric",
				"id_asig_sol" => "filled|string",
				"nom_ent_sol" => "filled|string",
				"nom_pet_sol" => "filled|string",
				"email_sol" => "filled|email",
				"regsol_est" => "filled|string",
				"usu_sol" => "filled|string",
				"ofic_usu_sol" => "filled|string",
				"mun_user_sol" => "filled|string",
				"mun_sol" => "filled|string",
            
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
