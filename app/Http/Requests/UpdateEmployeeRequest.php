<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * To handle validation of employee update
 *
 * @author Swam Htet Aung
 *
 * @create date 28-06-2023
 *
 */
class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @author Swam Htet Aung
     *
     * @create date 28-06-2023
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @author Swam Htet Aung
     *
     * @create date 28-06-2023
     * @return array
     */
    public function rules()
    {
        $id = request()->employee;
        return [
            'employee_id' => 'required|numeric',
            'employee_code' => 'required',
            'employee_name' => 'required',
            'nrc_number' => ['required','regex:/^[^!@#$%^&*_+=~`[\]{}|:;"<>,.?\\\]+$/'],
            'email_address' => 'required|email|unique:employees,email_address,'.$id,
            'date_of_birth' => 'required',
            'photo'=>'mimes:jpeg,jpg,png|max:10240'
        ];
    }

    /**
     * Customize the validation error messages
     * @author Swam Htet Aung
     *
     * @create date 30-06-2023
     * @return array
     */
    public function messages()
    {
        return [
            'photo.max'=>'The photo may not be greater than 10 MBs.'
        ];
    }
}
