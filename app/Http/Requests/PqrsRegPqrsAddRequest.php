<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PqrsRegPqrsAddRequest extends FormRequest
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
				"tip_ent_sol" => "required",
				"id_ent_sol" => "required",
				"id_pet" => "required",
				"tip_sol" => "required",
				"medio_sol" => "required",
				"desc_sol" => "required",
				"regsol_photo" => "required",
				"regsol_dias" => "required",
				"usu_sol" => "required|string",
				"ofic_usu_sol" => "required|string",
				"mun_user_sol" => "required|string",
				"mun_sol" => "required|string",
            
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
