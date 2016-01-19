<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SoftwareRequest extends Request
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
	    switch($this->method()){
		    case 'POST':
			    return [
				    //
				    'nama' => 'required',
				    'versi' => 'required'
			    ];
		        break;
		    case 'PUT':
			    return [
				    //
				    'nama' => 'required',
				    'versi' => 'required'
			    ];
		        break
	    }

    }

    public function messages(){
        return [
            'nama.required' => 'Nama Must Be Filled',
            'versi.required' => 'Versi Must Be Filled'
        ];
    }
}
