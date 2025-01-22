<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PqrsResponAddRequest extends FormRequest
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
            
				"id_tip_ent" => "required",
				"id_ent_resp" => "required",
				"nombre_resp" => "required|string",
				"cargo_resp" => "required",
				"email_resp" => "required|email",
				"tel_resp" => "required|string",
				"mun_resp" => "required|string",
				"dpt_resp" => "required",
            
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
