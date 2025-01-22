<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PqrsEntAddRequest extends FormRequest
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
            
				"tip_ent" => "required",
				"nit_ent" => "required|string",
				"nom_ent" => "required|string",
				"dir_ent" => "nullable|string",
				"tel_ent" => "nullable|string",
				"email_ent" => "nullable|email",
				"mun_ent" => "nullable",
            
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
