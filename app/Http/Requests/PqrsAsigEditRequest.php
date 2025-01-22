<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PqrsAsigEditRequest extends FormRequest
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
            
				"id_rad_asig" => "filled|string",
				"tip_ent_asig" => "filled",
				"id_ent_asig" => "filled",
				"id_resp_asig" => "nullable",
				"email_asig" => "nullable",
				"observacion" => "filled",
            
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
